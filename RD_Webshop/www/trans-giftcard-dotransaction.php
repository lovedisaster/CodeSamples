<?php
     require_once('../library/GiftCard.php');
     require_once(SITE_root.'/library/Sales.php');
     //Commit gift card transactions iteratively. 
     try {    
     GiftCard::IterGiftCardTransact('R');         
            $result = 
            Sales::combinedFinalise
            ('G',$_SESSION['transaction']['salesordercode'],'','',0,'');
     }
     catch (Exception $e) {
            GiftCard::IterGiftCardTransact('V');
            //Sales order finalise exception.
            throw $e;
     } 
     localRedir('/trans-complete/');
?>
