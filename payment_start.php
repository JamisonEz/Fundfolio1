<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('functions.php');
$db = new DBController();
$user_info = ($db->getAllUserInfo());
if(!empty($_POST))
{
    
    $amount = $_POST['amount'];
    $folio_name = $_POST['folio_name'];
    $folio_description = $_POST['folio_description'];
    $folio_id = $_POST['folio_id'];
    $payment_method = $_POST['payment_method'];
    if($payment_method=='paypal')
    {
        $amount = $amount;
    }
    else if($payment_method=='stripe') //stripe
    {
        $amount = $amount/100;
    }
    
    $check_status = $db->updateFolioMatrix($folio_id, $amount, 'temp_'.$user_info['user_id'].'_'.strtotime('now'));
    if(strtolower($check_status)=='success')
    {
        //its good
        echo json_encode(array('status'=>true, 'message'=>'success'));
        exit;
    }
    else
    {
        echo json_encode(array('status'=>false, 'message'=>$check_status));
        exit;
    }
}
else
{
    echo json_encode(array('status'=>false, 'message'=>'Error'));
    exit;
}
?>
