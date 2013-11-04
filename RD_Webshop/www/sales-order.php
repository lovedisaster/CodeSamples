<?php

require_once(SITE_root.'/library/Sales.php');
require_once(SITE_root.'/library/Item.php');

$this->setFile(TEMPLATE_handler, 'sales-order.html');
$this->setBlock(TEMPLATE_handler, 'item', 'item_block');

$this->loginRequired();


$salesOrder = Sales::get($this->arg[0], $_SESSION['customerId']);


// Get shipping cost
$shipping = (float)$salesOrder->SalesOrderDetail->freightAmount;

if(count($salesOrder->SalesOrderLines->SalesOrderLine) ) {
	foreach($salesOrder->SalesOrderLines->SalesOrderLine as $itemSale) {

		$item = Item::get((string)$itemSale->itemcolourRef);
		$size = Item::getSize($item, (string)$itemSale->itemcolourRef, (string)$itemSale->sizeCode);


		$itemDetails = Item::getDetails($itemSale->itemcolourRef, $itemSale->sizeCode);

		$itemTotal = (float)$itemDetails->price * $itemSale->orderQuantity;

		$grandTotal += $itemTotal;
		$taxTotal += (float)$itemDetails->taxAmount ;

		$output = array('ITEM_DESC'			=> (string)$item->WebItem->description,
						'ITEM_COLOUR'		=> (string)$itemDetails->colourDescription,
						'ITEM_SIZE'			=> (string)$size->sizeDescription,
						'ITEM_CODE'			=> (string)$item->WebItem->itemCode,
						'ITEM_COLOUR_REF'	=> $colourRef,
						'ITEM_SIZE_REF'		=> $sizeRef,
						'ITEM_QTY'			=> number_format((float)$itemSale->orderQuantity,0),
						'ITEM_PRICE'		=> number_format((float)$itemDetails->price,2),
						'ITEM_TOTAL'		=> number_format($itemTotal,2),
			);
		$this->setVar($output);
		$this->parse('item_block','item',true);
	}
}
else
	$this->setVar('item_block','');


$output = array('ORDER_CODE' => $salesOrder->SalesOrderGet->salesorderCode,
				'SHIP_METHOD'=> (string)$salesOrder->SalesOrderDetail->shipMethodDescription,
				'SUB_TOTAL'	=> number_format($grandTotal - $taxTotal,2),
				'TAX'		=> number_format($taxTotal,2),
				'SHIPPING'	=> number_format($shipping,2),
				'GRAND_TOTAL' => number_format($grandTotal+$shipping,2));
$this->setVar($output);
