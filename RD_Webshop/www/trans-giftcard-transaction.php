<?php
    //If session has expeired, terminate current transaction.
    if(empty($_SESSION['transaction']['salesordercode']) || empty($_SESSION['transaction']['total'])){
        localRedir('/home/');
    }
    
    //Clear all relavant session when refreshing working page.
    $_SESSION['transaction']['banktransamount'] = 0;
    $_SESSION['transaction']['amounttopay'] = $_SESSION['transaction']['total'];
    $_SESSION['transaction']['currentbanktrans'] = 0;
    unset($_SESSION['cardList']);
    unset($_SESSION['transaction']["balance"]);
    
    $this->setFile(TEMPLATE_handler, 'trans-giftcard-transaction.html');
    $output = array(
    'SALESORDERCODE'=> $_SESSION['transaction']['salesordercode'],
    'TOTAL' => $_SESSION['transaction']['total'], 
    'AMOUNTTOPAY' => $_SESSION['transaction']['amounttopay'],
    'CURRENCY' => 'AUD');

    $this->setVar($output); 
?>
