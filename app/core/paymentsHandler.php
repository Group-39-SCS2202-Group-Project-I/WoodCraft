<?php

if (isset($_GET['action'])) {
    if($_GET['action'] === 'pay') {
        redirect('payments/pay');
        echo $jsonObj;
    }else if($_GET['action'] === 'confirmPayment') {
        redirect('payments/confirmPayment');
    }
} 
?>
