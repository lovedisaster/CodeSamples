<?php
//sleep(1);
session_start();
require_once('../../library/GiftCard.php');  
    $doc_line_id='';
    $currentTransAmount='';
    $return['iscompleted'] = false;
    if(empty($_POST['type'])){
        $return['error'] = true;
        $return['msg'] = "System error,please refresh the current page and resubmit your transaction records.";
    }else{
       if(empty($_SESSION['transaction']['total'])){
           $return['error'] = true;
           $return['msg'] = "This transaction has been terminated due to your server data has expired, you will be navigated to home page automatically.";
       }else{
       switch($_POST['type']){
           case 'insert':
                if(empty($_POST['cardNo'])||empty($_POST['amount'])){
                    $return['error'] = true;
                    $return['msg'] = "Transaction amount can not be empty or zero.";
                }else{
                    if(!$_POST['amount'].is_numeric()){
                        $return['error'] = true;
                        $return['msg'] = "Invalid number.";
                    }
                    elseif($_POST['amount'] <= 0 ){
                        $return['error'] = true;
                        $return['msg'] = "Invalid number.";
                    }elseif($_SESSION['transaction']['amounttopay'] == 0){
                        //Basically this won't happend.
                        $return['error'] = true;
                        $return['msg'] = "Amount to pay has been cleared, not more transaction needed.";
                    }
                    else{
                        //$_POST['amount']> 0                               
                        if($_POST['amount'] > $_SESSION['transaction']['amounttopay']){
                            $currentTransAmount = sprintf('%01.2f',(float)$_SESSION['transaction']['amounttopay']);
                        }else{
                            $currentTransAmount = sprintf('%01.2f',(float)$_POST['amount']);
                        }    
                            $cardNumber = $_POST['cardNo'];
                            //Generate new doclineid
                            $salesOrderCode = $_SESSION['transaction']["salesordercode"];
                            $currentPostFix = $_SESSION['transaction']["currentpostfix"];
                            $doc_line_id = $salesOrderCode.GiftCard::GetNextPostfix($currentPostFix);                                     
                            //Insert transaction into list
                            GiftCard::AddTransaction($cardNumber,$doc_line_id,$currentTransAmount);
                            $_SESSION['transaction']["currentpostfix"]++;
                            
                            //bcsub is used to invoid php float precision issue
                            $_SESSION['transaction']['amounttopay'] = bcsub($_SESSION['transaction']['amounttopay'],$currentTransAmount,2); 
                            $_SESSION['transaction']["balance"][$cardNumber] = bcsub($_SESSION['transaction']["balance"][$cardNumber],$currentTransAmount,2);
                            $return['error'] = false;
                            $return['amountdue'] = sprintf('%01.2f',$_SESSION['transaction']['amounttopay']);
                            $_SESSION['transaction']['banktransamount'] = $_SESSION['transaction']['amounttopay'];
                            $return['doclineid'] = $doc_line_id;
                            $return['transamount'] = $currentTransAmount;
                            if($return['amountdue'] == 0){
                                $return['iscompleted'] = true;
                            }
                    }
                }
           break;
           case 'delete':               
                if(empty($_POST['docLineId']) || empty($_POST['cardNo'])){
                    $return['error'] = true;
                    $return['msg'] = "System error,please refresh the current page and resubmit your transaction records.";
                }else{  
                    //succeed                  
                    //Get card number by doclineid
                    if($_SESSION['transaction']['currentbanktrans'] > 0){
                        $return['error'] = true;
                        $return['msg'] = "Gift card records has been locked, you must delete the bank transaction before delete a gift card transaction.";
                    }else{
                        $cardNumber = $_POST['cardNo'];
                        $docLineId = $_POST['docLineId'];
                        $currentTransAmount = sprintf('%01.2f',$_SESSION['cardList'][$cardNumber][$docLineId]);
                        //Delete transaction from list                
                        GiftCard::RemoveTransaction($cardNumber,$doc_line_id);
                        //If the selected giftcard record is susccesully deleted from list. 
                        if(empty($_SESSION['cardList'][$cardNumber][$doc_line_id])){
                            //When a gift card transaction is deleted, current transaction amount should be added back to amount due. Bcadd is used to invoid php float precision issue
                            $_SESSION['transaction']['amounttopay'] = bcadd($_SESSION['transaction']['amounttopay'],$currentTransAmount,2);
                            //When a gift card transaction is deleted, current transaction amount should be added back to card balance. Bcadd is used to invoid php float precision issue
                            $_SESSION['transaction']["balance"][$cardNumber] = bcadd($_SESSION['transaction']["balance"][$cardNumber],$currentTransAmount,2); 
                            $return['error'] = false;
                            $return['amountdue'] = sprintf('%01.2f',$_SESSION['transaction']['amounttopay']);
                            if($_SESSION['transaction']['currentbanktrans'] > 0){
                                $return['isbanktransexisted'] = true;
                            } 
                        //If the selected giftcard record is not susccesully deleted from list.
                        }else{
                            $return['error'] = true;
                            $return['msg'] = "System error, please reload current page and try again.";
                        }
                    }                
                }
           break;

           case 'add-bank-trans':
                    $return['error'] = true;
                    $return['msg'] = "System error, please reload current page and try again.";
                    if(!empty($_POST['transname'])){
                        $_SESSION['transaction']['banktranstype'] = $_POST['transname'];
                        $return['error'] = false;
                    }                    
                    //currentbanktrans will be used in bank transaction later.
                    $_SESSION['transaction']['currentbanktrans'] = $_SESSION['transaction']['amounttopay']; 
                    $return['transamount'] = sprintf('%01.2f',$_SESSION['transaction']['currentbanktrans']);
                    $_SESSION['transaction']['amounttopay'] = 0;   
                    $return['amountdue'] = sprintf('%01.2f',$_SESSION['transaction']['amounttopay']);               
           break; 
           
           case 'delete-bank-trans':
                    $return['error'] = false;
                    $_SESSION['transaction']['amounttopay'] = bcadd($_SESSION['transaction']['amounttopay'],$_SESSION['transaction']['currentbanktrans'],2);  
                    $_SESSION['transaction']['currentbanktrans'] = 0;
                    $return['amountdue'] = sprintf('%01.2f',$_SESSION['transaction']['amounttopay']); 
           break;     
       }
       }
    }
        
    echo json_encode($return);
?>