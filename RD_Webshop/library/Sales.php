<?php

require_once(dirname(__FILE__).'/RDWS.php');
require_once(dirname(__FILE__).'/Item.php');

/**
 *
 * Create and retrieve sales order from RDWS
 *
 * @package    ecommerce
 * @author     James Leckie <james.leckie@alaress.com.au>
 * @copyright   2010 Alaress Pty Ltd
 * @link        http://www.alaress.com.au
 * @version     SVN: $Id$
 *
 */
class Sales {

    /**
     * Create a sales order containing all items from the cart with the shipping location
     * This step is performed once the customer has confirmed the order, before being redirected to PayPal.
     * The order is left in a pending status at this stage.
     *
     * @param string $customer Customers ID
     * @param array $cart Users shopping cart from @$_SESSION
     * @param string $locationRef Site/Shipping location reference
     * @return SimpleXMLElement|bool
     */
	public function create($customer, $cart, $locationRef, $customerTypeCode = '') {

		$message['SalesOrderDetail'] = array(	'customerId'		=> $customer,
												'storeCode'			=> RDWS_STORE,
												'supplychannelCode' => RDWS_SUPPLYCHANNEL,
												'userCode'			=> RDWS_USER,
												'status'			=> 'Pending',
		);

		if($customerTypeCode)
		{
			$message['SalesOrderDetail'] ['customerTypeCode'] = $customerTypeCode;
		}

		if(is_array($cart)) {
			foreach($cart as $itemCode => $item) {

				list($itemRef, $colourRef, $sizeRef) = explode('-',$itemCode);

				/* Get all the item attributes */
				$itemDetail = Item::getDetails($colourRef, $sizeRef);

                if($itemDetail->sellable == 'N')
                {
                    // Check if item is sellable, else throw exception.
                    throw new Exception('Unable create sales order. An item in the cart is not for sale.');
                }
                
				$saleLine =	array(	'locationRef'		=> $locationRef,
									'orderQuantity'		=> $item['quantity'],
									'unitPrice'			=> $itemDetail->price,
								);
				/* Default to sellcodeCode but if we cant find it use itemColorRef/SizeCode as unique key */
				if((string)$itemDetail->sellcodeCode) {
					$saleLine['sellcodeCode'] = (string)$itemDetail->sellcodeCode;
				}
				else {
					$saleLine['itemcolourRef'] = $colourRef;
					$saleLine['sizeCode'] = $sizeRef;
				}

				$message['SalesOrderLines'][]['SalesOrderLine'] = $saleLine;

			}
		}
		else
			return false;

		$xml = RDWS::toXML($message);
		return RDWS::request('SalesOrderSubmit', $xml);
	}

    /**
     * This function takes the paramenters returned from PayPal and updates the users order.
     * This is either an approve or cancel depending on the result of the PayPal transaction.
     * All the additional PayPal transcation data is also stored at this stage.
     * @param string $orderCode
     * @param string $reference
     * @param float $amount
     * @param int $result
     * @param string $resultMessage
     * @return SimpleXMLElement
     */
	public function finalise($orderCode, $reference, $amount, $result, $resultMessage) {
		$message['ConfirmationDetail'] = array('salesorderCode'			=> $orderCode,
												'paymentReferenceNumber'	=> $reference,
												'userCode'					=> RDWS_USER,
												);

		/* Results other than zero are a fail */
		if($result == 0)
			$message['ConfirmationDetail']['action'] = 'Approve';
		else
			$message['ConfirmationDetail']['action'] = 'Cancel';

		$message['PaymentDetails']['PaymentDetail'] = array('paymentType'			=> 'PAYPAL',
															'paymentReferenceNumber'=> $reference,
															'paymentAmount'			=> $amount,
															'currencyCode'			=> 'AUD',
															'paymentResultCode'		=> $result,
															'paymentResponseMessage'=> $resultMessage,
															);
		$xml = RDWS::toXML($message);
		return RDWS::request('SalesOrderFinalise', $xml);
	}
    
    public function combinedFinalise($type,$orderCode, $reference, $amount, $result, $resultMessage) {
        $message['ConfirmationDetail'] = array('salesorderCode'            => $orderCode,
                                                'userCode'                    => RDWS_USER,
                                                );
        /* Results other than zero are a fail */
        if($result == 0)
            $message['ConfirmationDetail']['action'] = 'Approve';
        else
            $message['ConfirmationDetail']['action'] = 'Cancel';
        
        //If giftcard payment has been commited.    
        if(isset($_SESSION['committedCardList'])) {                                                    
            foreach($_SESSION['committedCardList'] as $cardNo => $cardValues){
                foreach($cardValues as $doc_line_id => $trans_amount){
                    $message['PaymentDetails'][]['PaymentDetail'] = 
                    array('paymentType'            => 'GC1',
                          'paymentReferenceNumber'=> $doc_line_id,
                          'paymentAmount'            => $trans_amount,
                          'currencyCode'            => 'AUD',
                          'giftcardInd'            => 'Y'
                          );
                }
            }
        }
        
        //Bank tender
        if($type == 'B'){

        $message['PaymentDetails'][]['PaymentDetail'] = array('paymentType'            => 'PAYPAL',
                                                            'paymentReferenceNumber'=> $reference,
                                                            'paymentAmount'            => $amount,
                                                            'currencyCode'            => 'AUD',
                                                            'paymentResultCode'        => $result,
                                                            'paymentResponseMessage'=> $resultMessage,
                                                            );
        }
        
        $xml = RDWS::toXML($message);
        //print($xml);
        //die();
        return RDWS::request('SalesOrderFinalise', $xml);
    }

    /**
     * Allows a basic cancel of the order if the user cancels the order at any stage.
     * @param string $orderCode
     * @return SimpleXMLElement
     */
	public function cancel($orderCode) {
		$message['ConfirmationDetail'] = array('salesorderCode'			=> $orderCode,
												'userCode'					=> RDWS_USER,
												'action'					=>'Cancel'
												);
		$xml = RDWS::toXML($message);
		return RDWS::request('SalesOrderFinalise', $xml);
	}

    /**
     * Searches for a customers previous sales orders
     * @param string $customerId
     * @param int $pageNumber
     * @param int $pageSize
     * @return SimpleXMLElement
     */
	public function find($customerId, $pageNumber = -1, $pageSize = 10) {

		$message = array(	'customerId'	=> $customerId,
							'pageNumber'	=> $pageNumber,
							'pageSize'		=> $pageSize,
							'pendingInd'	=> 'N'
		);

		return RDWS::sendArray('SalesOrderFind', $message);
	}

    /**
     * Retrieve a sales orders details
     * @param string $salesorderCode
     * @param string $customerId
     * @return SimpleXMLElement
     */
	public function get($salesorderCode, $customerId) {
		$message = array('salesorderCode'	=> $salesorderCode,
						 'customerId'		=> $customerId,);

		return RDWS::sendArray('SalesOrderGet', $message);
	}

    /**
     * Create a sales order containing all items from the cart with the shipping location
     * This step is performed once the customer has confirmed the order, before being redirected to PayPal.
     * The order is left in a pending status at this stage.
     *
     * @param string $customer Customers ID
     * @param array $cart Users shopping cart from @$_SESSION
     * @param string $locationRef Site/Shipping location reference
     * @return SimpleXMLElement|bool
     */
	public function calculate($cart, $customer = '', $locationRef = '', $customerTypeCode = '') {

		$message['SalesOrderDetail'] = array(	'storeCode'			=> RDWS_STORE,
												'supplychannelCode' => RDWS_SUPPLYCHANNEL,
												'userCode'			=> RDWS_USER,
		);

		if($customer)
		{
			$message['SalesOrderDetail'] ['customer'] = $customer;
		}

		if($customerTypeCode)
		{
			$message['SalesOrderDetail'] ['customerTypeCode'] = $customerTypeCode;
		}

		if(is_array($cart)) {
			foreach($cart as $itemCode => $item) {

				list($itemRef, $colourRef, $sizeRef) = explode('-',$itemCode);

				/* Get all the item attributes */
				$itemDetail = Item::getDetails($colourRef, $sizeRef);

				$saleLine =	array(	'orderQuantity'		=> $item['quantity'],
									'unitPrice'			=> $itemDetail->price,
								);

				if($locationRef)
				{
					$saleLine['locationRef'] = $locationRef;
				}

				/* Default to sellcodeCode but if we cant find it use itemColorRef/SizeCode as unique key */
				if((string)$itemDetail->sellcodeCode) {
					$saleLine['sellcodeCode'] = (string)$itemDetail->sellcodeCode;
				}
				else {
					$saleLine['itemcolourRef'] = $colourRef;
					$saleLine['sizeCode'] = $sizeRef;
				}

				$message['SalesOrderLines'][]['SalesOrderLine'] = $saleLine;

			}
		}
		else
			return false;

		$xml = RDWS::toXML($message);
		return RDWS::request('SalesOrderCalculatePrice', $xml);
	}

	/**
	 * Retrieve frieght cost given the destination and cart contents
	 * @param string $destCountry
	 * @param array $cart
	 * @return SimpleXMLElement
	 */
/*	public function getFreight($destCountry, $cart) {

		$message['GetFreightMethodsCosts'] = array(	'locationCode'		=> RDWS_STORE,
													'countryCode'			=> $destCountry
		);

		if(is_array($cart)) {
			foreach($cart as $itemCode => $item) {

				list($itemRef, $colourRef, $sizeRef) = explode('-',$itemCode);
*/
				/* Get all the item attributes */
/*				$itemDetail = Item::getDetails($colourRef, $sizeRef);

				$itemList =	array(	'itemColourRef'		=> $colourRef,
									'quantity'		=> $item['quantity'],
								);

				$message['GetFreightMethodsCosts']['itemList'][]['ItemList'] = $itemList;

			}
		}
		else
			return false;

		$xml = RDWS::toXML($message);
		return RDWS::request('GetFreightMethodsCosts', $xml);

	}
	*/

}

