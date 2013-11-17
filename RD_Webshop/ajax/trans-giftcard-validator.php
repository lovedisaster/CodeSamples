<?php
//sleep(2);
session_start();
require_once('../../library/GiftCard.php');

if (empty($_POST['cardNo'])) {
    $return['error'] = false;
    $return['msg'] = 'You have not entered your card number yet.';
}
else{
    $cardNumber = $_POST['cardNo'];
    $result = GiftCard::CreditEnquire($cardNumber);
    $balance = 0;
    if((float)$result -> VoucherDetails ->current_balance == 0){
        $return['error'] = false;
        $return['msg'] = 'The card has been fully redeemed.';
    }
    else {
        if(empty($_SESSION['transaction']["balance"][$cardNumber])){
            $_SESSION['transaction']["balance"][$cardNumber] = (float)$result -> VoucherDetails ->current_balance;
        }
        $return['error'] = true;
        $return['msg'] = 'You have $'.(float)$result -> VoucherDetails ->current_balance.' credit.Click next to continue gift card transactions.';
        //Generate default value.
        $return['defaultValue'] = '';
        if($_SESSION['transaction']["balance"][$cardNumber] > $_SESSION['transaction']['amounttopay']){
            $return['defaultValue'] = $_SESSION['transaction']['amounttopay'];
        }else{
            $return['defaultValue'] = $_SESSION['transaction']["balance"][$cardNumber]; 
        }
        $return['balance'] = $_SESSION['transaction']["balance"][$cardNumber];
        $return['cardNo'] = $_POST['cardNo'];
    }
}

echo json_encode($return);
?>