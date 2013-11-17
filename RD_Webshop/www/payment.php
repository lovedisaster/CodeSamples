<?php
	// Get the payment library
	require_once('../library/Payment.php');
	require_once('../library/Customer.php');
	require_once('../library/Sales.php');
	require_once('../library/Page.php');
	require_once('../include/helper.php');
	require_once('../library/Cart.php');

	// Page is used to handle exceptions thrown and sessions
	$page = new Page;

	// Check if customer is logged in
	if($_SESSION['customerId'])
	{
		// Check cart
		if($_SESSION['cart'])
		{
			if($_SESSION['checkout']['shippingRef'])
			{
				/* Cancel existing sales orders and create a new one */
				if($_SESSION['checkout']['salesOrder']) {
					Sales::cancel($_SESSION['checkout']['salesOrder']);
				}

				/* Create sales order */
				$salesOrder = Sales::create($_SESSION['customerId'],  $_SESSION['cart'], $_SESSION['checkout']['shippingRef'], $_SESSION['customerTypeCode']);
				$_POST['PONUM'] = (string)$salesOrder->SalesOrderDetail->salesorderCode;
                
                //Clear all lagacy sessions when a new salesorder submited
                if(isset($_SESSION['transaction'])){
                    unset($_SESSION['transaction']);
                    if(isset($_SESSION['cardList'])){
                        unset($_SESSION['cardList']);
                    }
                }
                
                $_SESSION['transaction']['salesordercode'] = $_POST['PONUM'];
				if($_POST['PONUM'])
				{
					//Process the payment
                    //Payment::makePayment($_POST, 'MOCKPAYMENT');
                    //Redirect to paymentselection page.
                    
                    //Initialise transactionData
                    //TransactionFactory::addTransactionData($_SESSION['salesordercode']);
                    //$transactionData = TransactionFactory::getTransactionData($_SESSION['salesordercode']);
                    //$transactionData->setOutstandingAmount($_POST['AMOUNT']);
                    //$transactionData->setTotal($_POST['AMOUNT']); 
                    $_SESSION['transaction']['amounttopay'] = $_POST['AMOUNT'];
                    $_SESSION['transaction']['total'] = $_POST['AMOUNT'];
                    localRedir('/trans-giftcard-transaction/');
				}
				else
				{
					throw new Exception('Unable to create sales order, please try again later.');
				}
			}
			else
			{
				throw new Exception('Please select a shipping address.');
			}
		}
		else
		{
			throw new Exception('Cart is empty, please add items to cart.');
		}
	}
	else {
		throw new Exception('Please login.');
	}
        
?>