<?php

require_once('functions.php');
error_reporting(E_ERROR);


//just function definition
$functions = array('like_campaign'=> array('user_id', 'campaign_id'), 'countcp_for_social' => array('social_channel','user_id','campaign_id'));

if(isset($_POST))
{
    $db = new DBController();
    if($_POST['function_name']=="")
    {
        return false;
    }
    
    if(in_array($_POST['function_name'], array_keys($functions)))
    {
        $function_name = $_POST['function_name'];
        $params = array();
        if(!empty($_POST['function_params']) && (count($_POST['function_params']) == count($functions[$function_name])))
        {
            $params = $_POST['function_params'];
            $response = $function_name($params, $db);
        }
    }
    else
    {
        return false;
    }
}

function like_campaign($params_array, $db)
{
    
    $query = "SELECT * FROM `user_campaign_rel` where userid = '{$params_array['user_id']}' AND campaignid = '{$params_array['campaign_id']}'";
    $result = mysqli_query( $db->conn, $query ) or die(mysqli_error($db->conn));
    if($result && mysqli_num_rows($result) > 0)
    {
        $sql = mysqli_query( $db->conn , "UPDATE `user_campaign_rel` SET `has_liked` = 1, `updated_on` = NOW() WHERE `user_campaign_rel`.`campaignid` = {$params_array['campaign_id']} AND userid = {$params_array['user_id']};");
        if($sql)
        {
            $db->addCommunityPoints($params_array['user_id'], 5); //5 points for liking the campaign
            echo json_encode(array('status'=>true, 'message'=>'success'));
        } 
        else
            echo json_encode(array('status'=>false, 'message'=>'error occured'));
        exit;
    }
    else
    {
        $sql = mysqli_query( $db->conn , "INSERT INTO `user_campaign_rel` (`id`, `userid`, `campaignid`, `has_liked`, `facebook_shared`, `twitter_shared`, `created_on`, `updated_on`) VALUES (NULL, {$params_array['user_id']}, '{$params_array['campaign_id']}', '1', '', '', NOW(), NOW());");
        if($sql)
        {
            $db->addCommunityPoints($params_array['user_id'], 5); //5 points for liking the campaign
            echo json_encode(array('status'=>true, 'message'=>'success'));
        } 
        else
            echo json_encode(array('status'=>false, 'message'=>'error occured'));
        exit;
    }
}

function countcp_for_social($params_array, $db)
{
    $social_channel_name = isset($params_array['facebook']) ? 'facebook' : (isset($params_array['twitter']) ? 'twitter' : "");
    $post_id = $params_array[$social_channel_name];
    
    if($social_channel_name=="")
        return json_encode(array('status'=>false, 'message'=>'no social channel found'));
    
    $query = "SELECT * FROM `user_campaign_rel` where userid = '{$params_array['user_id']}' AND campaignid = '{$params_array['campaign_id']}'";
    $result = mysqli_query( $db->conn, $query ) or die(mysqli_error($db->conn));
    if($result && mysqli_num_rows($result) > 0)
    {
        $db_column_name = $social_channel_name.'_shared';
        $sql = mysqli_query( $db->conn , "UPDATE `user_campaign_rel` SET `$db_column_name` = $post_id, `updated_on` = NOW() WHERE `user_campaign_rel`.`campaignid` = {$params_array['campaign_id']} AND userid = {$params_array['user_id']};");
        
        if($sql)
        {
            if($social_channel_name=='facebook')
                $db->addCommunityPoints($params_array['user_id'], 5); //5 points for sharing on social media
            echo json_encode(array('status'=>true, 'message'=>'success'));
        } 
        else
            echo json_encode(array('status'=>false, 'message'=>'error occured'));
        exit;
    }
    else
    {
        $sql = '';
        if($social_channel_name=='facebook')
            $sql = mysqli_query( $db->conn , "INSERT INTO `user_campaign_rel` (`id`, `userid`, `campaignid`, `has_liked`, `facebook_shared`, `twitter_shared`, `created_on`, `updated_on`) VALUES (NULL, {$params_array['user_id']}, '{$params_array['campaign_id']}', '', '$post_id', '', NOW(), NOW());");
        else if($social_channel_name=='twitter')
            $sql = mysqli_query( $db->conn , "INSERT INTO `user_campaign_rel` (`id`, `userid`, `campaignid`, `has_liked`, `facebook_shared`, `twitter_shared`, `created_on`, `updated_on`) VALUES (NULL, {$params_array['user_id']}, '{$params_array['campaign_id']}', '', '', '1', NOW(), NOW());");
            
        if($sql)
        {
            if($social_channel_name=='facebook')
                $db->addCommunityPoints($params_array['user_id'], 5); //5 points for sharing on social media
            echo json_encode(array('status'=>true, 'message'=>'success'));
        } 
        else
            echo json_encode(array('status'=>false, 'message'=>'error occured'));
        exit;
    }
}
