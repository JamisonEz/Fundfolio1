<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('functions.php');
require_once('stripe-php-4.3.0/init.php');
$db = new DBController();
$user_info = ($db->getAllUserInfo());
if(!empty($_POST))
{
    \Stripe\Stripe::setApiKey("sk_test_yrJxH5cWyaUzTTRG0VzkToc6"); 
    
    $amount = $_POST['amount'];
    $token = $_POST['token']['id'];
    $folio_name = $_POST['folio_name'];
    $folio_description = $_POST['folio_description'];
    $folio_id = $_POST['folio_id'];
    
    try {
        $charge = \Stripe\Charge::create([
            'amount' => $amount, //cents in US dollar
            'currency' => 'usd',
            'card' => $token,
            'description' => 'Donation of $'.($amount/100).' for '.$folio_name.' campaign'
        ]);
        
        if(!empty($charge))
        {
            $charge_info = $charge;
            if(isset($charge_info['status']) && $charge_info['status']=='succeeded')
            {
                $data = array();
                $data['txn_id'] = $charge_info['id'];
                $data['payment_amount'] = $charge_info['amount']/100;
                $data['payment_status'] = 'success';
                $data['item_number'] = $folio_id;
                $data['userid'] = $user_info['user_id'];
                        
                $db->updatePayments($data);
                $db->updateFolioMatrix($folio_id, $amount/100, $user_info['user_id']);
            }
            
        }
        
    } catch (Stripe_CardError $e) {
        // Declined. Don't process their purchase.
        // Go back, and tell the user to try a new card
        
        echo "Error Occured while payment";
        exit;
    }
}
else
{
    echo "Error";
    exit;
}
?>
