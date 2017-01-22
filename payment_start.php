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
    
    $check_status = $db->updateFolioMatrix($folio_id, $amount/100, 'temp_'.$user_info['user_id'].'_'.strtotime('now'));
    if(strtolower($check_status)=='success')
    {
        //its good
        echo json_encode(array('status'=>true, 'message'=>'success'));
        exit;
    }
    else
    {
        echo json_encode(array('status'=>false, 'message'=>'Someone is already donating at this amount, please try after 2 minutes'));
        exit;
    }
}
else
{
    echo json_encode(array('status'=>false, 'message'=>'Error'));
    exit;
}
?>
