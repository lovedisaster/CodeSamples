<?php

     session_id($_POST['SESSIONID']);
     session_start();
     require_once('../library/GiftCard.php');
     require_once(SITE_root.'/library/Sales.php');
     //Commit gift card transactions iteratively. 
     try {
            /**
            * 1. Commit all gift card transactions saved in session if there are any.
            * 2. Finalise sales order with possibly multiple tenders.   
            */
            if(!empty($_SESSION['cardList'])){
            GiftCard::IterGiftCardTransact('R');    
            }   
            
            $result = Sales::combinedFinalise
            ('B',$_POST['PONUM'], $_POST['PNREF'], $_POST['AMOUNT'], $_POST['RESULT'], $_POST['RESPMSG']);
            header('HTTP/1.1 200 OK');
     }
     catch (Exception $e) {
            //Once sales order finalise exception happened, reverse all transactions.
            //print_r($e);
            if(!empty($_SESSION['committedCardList'])){
            GiftCard::IterGiftCardTransact('V');
            }
            //Clear all card transactions after reverse transaction is done.
            unset($_SESSION['checkout']);
            unset($_SESSION['cart']);
            //Clear all giftcard sessions when a new salesorder submited
            if(isset($_SESSION['transaction'])){
            unset($_SESSION['transaction']);
            }
            if(isset($_SESSION['cardList'])){
                unset($_SESSION['cardList']);
            }
            if(isset($_SESSION['committedCardList'])){
                unset($_SESSION['committedCardList']);
            }
            header('HTTP/1.1 500 Internal Server Error');
     }       

    require_once('../library/GiftCard.php');  
    //If session has expired, terminate current transaction.
    

    //All session will be null possibly : 1. An error has occured which should trigger session being cleared. 2. Session expired. 
    if(!isset($_SESSION['transaction']['salesordercode']) || !isset($_SESSION['transaction']['total']))   {        
          localRedir('/trans-error?type=TRANSACTIONERROR');    
    }  
            
    $this->setFile(TEMPLATE_handler, 'trans-giftcard-complete.html');
    $this->setBlock(TEMPLATE_handler, 'gtransaction', 'gtransaction_ref');
    if(empty($_SESSION['cardList'])){
        $output = array(
                'PAYMENTDETAIL'=> $_SESSION['transaction']['bankpayment'],     
                'AMOUNT' => $_SESSION['transaction']['amounttopay']);
                $output['SALESORDERCODE'] = $_SESSION['transaction']['salesordercode'];
                $output['TOTAL'] = $_SESSION['transaction']['total'];
                $output['AMOUNTTOPAY'] = 0;
                $output['CURRENCY'] = 'AUD';
                $this->setVar($output); 
                $this->parse('gtransaction_ref', 'gtransaction', true);
    }else{
        foreach($_SESSION['cardList'] as $cardNo => $cardValues){
            foreach($cardValues as $doc_line_id => $trans_amount){
                $output = array( 
                'PAYMENTDETAIL' => 'Gift Card: '.$cardNo,
                'AMOUNT' => $trans_amount);
                $output['SALESORDERCODE'] = $_SESSION['transaction']['salesordercode'];
                $output['TOTAL'] = $_SESSION['transaction']['total'];
                $output['AMOUNTTOPAY'] = $_SESSION['transaction']['amounttopay'];
                $output['CURRENCY'] = 'AUD';
                $this->setVar($output); 
                $this->parse('gtransaction_ref', 'gtransaction', true);
            }
        }
            if(!empty($_SESSION['transaction']['bankpayment'])){
                $output = array(
                'PAYMENTDETAIL' => $_SESSION['transaction']['bankpayment'],     
                'AMOUNT' => $_SESSION['transaction']['amounttopay']);
                $output['SALESORDERCODE'] = $_SESSION['transaction']['salesordercode'];
                $output['TOTAL'] = $_SESSION['transaction']['total'];
                $output['AMOUNTTOPAY'] = 0;
                $output['CURRENCY'] = 'AUD';
                $this->setVar($output); 
                $this->parse('gtransaction_ref', 'gtransaction', true);
            }
    }
    
    unset($_SESSION['checkout']);
    unset($_SESSION['cart']);
    //Clear all giftcard sessions when a new salesorder submited
    if(isset($_SESSION['transaction'])){
    unset($_SESSION['transaction']);
    if(isset($_SESSION['cardList'])){
        unset($_SESSION['cardList']);
    }
    if(isset($_SESSION['committedCardList'])){
        unset($_SESSION['committedCardList']);
    }
}
?>
