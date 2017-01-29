<?php

include_once 'googlelogin.php';
class DBController {
	
	private $host = "localhost"; //database location
	private $user = "root"; //database username
        
	private $password = "";
	private $database = "ahartwel_fundfolio";
        private $port = '';
	
	public  $conn;
	
	var $rand_key;
	//global $link;
	
	function __construct() {
                if($_SERVER['HTTP_HOST'] != 'localhost')
                {
                    $this->database = 'paypal_donate';
                    $this->user = 'paypal_users';   
                    $this->password = 'Launchafolio@2017';
                    $this->port = ''; 
                }
            
		 $this->conn = $this->connectDB();
		if(!empty( $this->conn)) {
			$this->selectDB( $this->conn);
		}
		$this->rand_key = '0iQx5oBk66oVZep';
                
                error_reporting(E_ERROR);
	}
	
	function connectDB() {
		$this->conn = mysqli_connect($this->host,$this->user,$this->password);
		if ( $this->conn->connect_error) {
			die("Connection failed: " .  $this->conn->connect_error);
		}

		return $this->conn;
	}
	
	function selectDB($conn) {
		$db_selected = mysqli_select_db($this->conn,$this->database);
		
		if (!$db_selected) {
			die ('Can\'t use foo : ' . mysqli_error(  $this->conn ));
		}
	}




	// functions.php
	function check_txnid($tnxid){
		//global $link;
		//return true;
		$valid_txnid = true;
		//get result set
		$sql = mysql_query("SELECT * FROM `fundfolio_payments` WHERE txnid = '$tnxid'", $conn);
		if ($row = mysql_fetch_array($sql)) {
			$valid_txnid = false;
		}
		return $valid_txnid;
	}

	function check_price($price, $id){
		$valid_price = false;
		//you could use the below to check whether the correct price has been paid for the product
		
		/*
		$sql = mysql_query("SELECT amount FROM `products` WHERE id = '$id'");
		if (mysql_num_rows($sql) != 0) {
			while ($row = mysql_fetch_array($sql)) {
				$num = (float)$row['amount'];
				if($num == $price){
					$valid_price = true;
				}
			}
		}
		return $valid_price;
		*/
		return true;
	}

	function userRegister ( $email , $paw ,$name , $location , $image, $socialid='' ){

		$pwdmd5 = md5($paw);
		
		$query = "SELECT *
				FROM `register` 
				where email = '$email' 	";
				
		$result = mysqli_query( $this->conn, $query ) or die(mysqli_error($this->conn));
		if($result && mysqli_num_rows($result) > 0)
        {
			return "2";
		}
				
		$sql = mysqli_query(  $this->conn , "INSERT INTO `register`( `email` , `password` , `name`, `location` , `profilepic`, `socialid`) 
						VALUES ( 						
						'$email' ,					
						'$pwdmd5' ,	
						'$name' ,	
						'$location' ,							
						'$image',
                        '$socialid'
						)");
						
						
				if($sql){
					
					
					if(!isset($_SESSION)){ session_start(); }
			
			$_SESSION[$this->GetLoginSessionVar()] = $email; 
			
					$responce = "1";
					
					$_SESSION['type'] =  0 ;
					$_SESSION['user_id'] =  mysqli_insert_id( $this->conn) ;
					$_SESSION['user_name']  = $name ;
					$_SESSION['user_email'] = $email;
					$_SESSION['user_image'] = $image;
					$_SESSION['user_location'] = $location;
				}
				else{

					$responce = "0";
				}
				return 	$responce;	
		
	}
	
	function registerFbUser ( $fbid , $femail , $fbfullname , $fimage , $location ){

		//$pwdmd5 = md5($paw);
		
		
		
		
		
		
		$query = "SELECT *
				FROM `register` 
				where socialid = '$fbid' 	";
				
		$result = mysqli_query( $this->conn, $query ) or die(mysqli_error($this->conn));
		if($result && mysqli_num_rows($result) > 0)
        {
			//return "2";
			
			if(!isset($_SESSION)){ session_start(); }
			
				$_SESSION[$this->GetLoginSessionVar()] = $fbid;
			
					
				$row = mysqli_fetch_assoc($result);
				
					$_SESSION['type'] =  1 ;
					$_SESSION['user_id'] = $row['id'] ;
					$_SESSION['user_name']  = $fbfullname ;
					$_SESSION['user_email'] =  $femail;
					$_SESSION['user_image'] = $fimage;
					$_SESSION['user_location'] = $location;
					
			
		}
		else{
				
		$sql = mysqli_query(  $this->conn , "INSERT INTO `register`( `socialid`, `name` , `profilepic` , `location` ) 
						VALUES ( 						
						'$fbid' ,					
						'$fbfullname' ,						
						'$fimage' ,
						'$location' 
						)");
						
						
				if($sql){
					$responce = "1";
					
					if(!isset($_SESSION)){ session_start(); }
			
					$_SESSION[$this->GetLoginSessionVar()] = $fbid;
			
					
				
				
					$_SESSION['type'] =  1 ;
					$_SESSION['user_id'] = mysqli_insert_id( $this->conn) ;
					$_SESSION['user_name']  = $fbfullname ;
					$_SESSION['user_email'] =  $femail;
					$_SESSION['user_image'] = $fimage;
					$_SESSION['user_location'] = $location;
					
					
				}
				else{

					$responce = "0";
				}
		}
				return 	$responce;	
		
	}
	
	function login ( $email , $paw, $google_login_success=false){
		
		$pwdmd5 = md5($paw);
		$query = "SELECT *
				FROM `register` 
				where email = '$email'";
                if(!$google_login_success)
                {
                    $query .= " and password = '$pwdmd5'";
                }
				
		$result = mysqli_query( $this->conn, $query ) or die(mysqli_error($this->conn));
			
		if(($result && mysqli_num_rows($result) > 0) || $google_login_success)
        {
			
			if(!isset($_SESSION)){ session_start(); }
			
			$_SESSION[$this->GetLoginSessionVar()] = $email;
		
				
			$row = mysqli_fetch_assoc($result);
			
			$_SESSION['type'] =  0 ;
			
			$_SESSION['user_id'] = $row['id'];
			$_SESSION['user_name']  = $row['name'];
			$_SESSION['user_email'] = $row['email'];
                        $_SESSION['community_points'] = $row['community_points'];
			$_SESSION['user_image'] = $row['profilepic'];
			
			$_SESSION['user_location'] = $row['location'];

			//$_SESSION['type_of_user'] = $row['type'];
		   
			
			
            return true;
        }
		else{
			return false;
		}
        
        

		
	}
	
	
	 function CheckLogin()
    {
         if(!isset($_SESSION)){ session_start(); }

         $sessionvar = $this->GetLoginSessionVar();
         
         if(empty($_SESSION[$sessionvar]))
         {
            return false;
         }
         return true;
    }
	
	
	function UserType()
    {
        return isset($_SESSION['type'])?$_SESSION['type']:'';
    }
	
	
	
	
	function UserUserID()
    {
		
        return isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
    }
		
	function UserEmail()
    {
        return isset($_SESSION['user_email'])?$_SESSION['user_email']:'';
    }
	
	
	function UserName()
    {
        return isset($_SESSION['user_name'])?$_SESSION['user_name']:'';
    }
	function UserImage()
    {
        return isset($_SESSION['user_image'])?$_SESSION['user_image']:'';
    }
	
	function UserLocation()
    {
        return isset($_SESSION['user_location'])?$_SESSION['user_location']:'no';
    }
	
	
	
	function LogOut()
    {
        session_start();
        
        $sessionvar = $this->GetLoginSessionVar();
        
        $_SESSION[$sessionvar]=NULL;
        
        unset($_SESSION[$sessionvar]);
        
        if(isset($_SESSION['g_token']))
            unset($_SESSION['g_token']);
        
        if ($google_client && $google_client->getAccessToken()) {
            //Reset OAuth access token
            $google_client->revokeToken();
            //Destroy entire session
            session_destroy();
        }
    }
	
	function GetLoginSessionVar()
    {
        $retvar = md5($this->rand_key);
        $retvar = 'usr_'.substr($retvar,0,10);
	
        return $retvar;
    }
    
	
	function  addCampaign (  $campaignname , $tag_line ,  $description ,  $campaignimage , $campaignvidio ,  $amount ,  $days ,  $total_backers ,  $isfunded ,  $categoryid ,$company_location , $quote_input , $link , $loginid ){
		
		 $query = "INSERT INTO `campaign` ( `campaignname`,`tag_line` ,`description`, `campaignimage`, `campaignvidio` , `amount`, `days`, `total_backers`, `isfunded`, `categoryid`, `company_location` , `quote_input` , `link` ,`latitude`, `longitude`, `loginid`, `u_date`) VALUES (
					'".$campaignname."' ,
					'".$tag_line."' ,
					'".$description."' ,
					'".$campaignimage."' ,
					'".$campaignvidio."' ,
					'".$amount."' ,
					'".$days."' ,
					'".$total_backers."' ,
					'".$isfunded."' ,
					'".$categoryid."' ,

					'".$company_location."' ,
					'".$quote_input."' ,
					'".$link."' ,
					'' ,
					'' ,
					'".$loginid."' ,
						
					'".date("Y-m-d H:i:s")."'
					)";
					
				
		
		$sql = mysqli_query( $this->conn , $query );
                $id = mysqli_insert_id( $this->conn);
                if($sql)
                {
                    $this->addCampaignMatrix($id, $amount);
                }
                return $id;
	}
	

	function getCampaign( $cat_id ){
		
		
		
			$where  = " 1=1 ";

			if( isset( $cat_id ) && ( $cat_id != -1) && ( $cat_id < 11) ){
				$where  .="and c.categoryid=".$cat_id; 
			}
			
		
			
			$query = "SELECT cat.categorytype , c.* , COUNT(g.campaignid) as total_doner , SUM(g.amount) as total_amount 
				FROM `campaign` as c
				LEFT JOIN  gifts as g  ON  g.campaignid = c.campaignid
                 LEFT JOIN category as cat ON cat.categoryid = c.categoryid
				 
				where $where
				
				GROUP by c.campaignid
				ORDER BY c.c_date DESC ";
				
				
				
			$sql = mysqli_query( $this->conn, $query ) or die(mysqli_error($this->conn));

			//$sql = mysqli_query( $this->conn, "SELECT * FROM `campaign` where $where") or die(mysqli_error($this->conn));
			
			$res = array();
			while($row = mysqli_fetch_assoc($sql)) {
			     $res[] = $row;
			}
			return $res;
			
		
	}
	
	
	
	function getCampaignByUser( $user_id ){
		
		
		
			$where  = " 1=1 ";

			if( isset( $user_id ) && ( $user_id != -1)){
				$where  .="and c.loginid=".$user_id; 
			}
			
		
			
			 $query = "SELECT cat.categorytype , c.* , COUNT(g.campaignid) as total_doner , SUM(g.amount) as total_amount 
				FROM `campaign` as c
				LEFT JOIN  gifts as g  ON  g.campaignid = c.campaignid
                 LEFT JOIN category as cat ON cat.categoryid = c.categoryid
				 
				where $where
				
				GROUP by c.campaignid
				ORDER BY c.c_date DESC ";
				
			
				
			$sql = mysqli_query( $this->conn, $query ) or die(mysqli_error($this->conn));

			//$sql = mysqli_query( $this->conn, "SELECT * FROM `campaign` where $where") or die(mysqli_error($this->conn));
			
			$res = array();
			while($row = mysqli_fetch_assoc($sql)) {
			     $res[] = $row;
			}
			return $res;
			
		
	}
	
	
	
	
	
	
	function getTotalDonateAmount(){
	
		
		
			$sql = mysqli_query( $this->conn, "SELECT sum( payment_amount ) as total_amount FROM `fundfolio_payments`") or die(mysqli_error($this->conn));
			
			if (mysqli_num_rows($sql) > 0) 
				return mysqli_fetch_assoc( $sql);
			else
				return false;
			
		
	}
	
	function getTotalDonateCount(){
	
		
		
			$sql = mysqli_query( $this->conn ,"SELECT COUNT(id) as total_donate FROM `fundfolio_payments`");
			return mysqli_fetch_array($sql);
	
	}

	function updatePayments($data){
		//global $link;
		
		if (is_array($data)) {
			$sql = mysqli_query( $this->conn , "INSERT INTO `fundfolio_payments` (txnid, payment_amount, payment_status, itemid, userid, createdtime) VALUES (
					'".$data['txn_id']."' ,
					'".$data['payment_amount']."' ,
					'".$data['payment_status']."' ,
					'".$data['item_number']."' ,
                                        '".$data['userid']."' ,
					'".date("Y-m-d H:i:s")."'
					)");
			return mysqli_insert_id( $this->conn);
		}
	}
	//Get Payment list
	function getPaymentDetails(){
            $sql = mysqli_query( $this->conn ,"SELECT * FROM `fundfolio_payments`");
            $arr = array();
            while($row = mysqli_fetch_assoc($sql)) {
                 $arr[] = intval($row['payment_amount']);
            }
            return $arr;
	
	}
        
    function getAllCategory(){
        $sql = mysqli_query( $this->conn ,"SELECT * FROM `category`");
        $arr = array();
        while($row = mysqli_fetch_assoc($sql)) {
             $arr[$row['categoryid']] = $row['categorytype'];
        }
        return $arr;

    }
	
	
	 function getCampaignLike( $comp_id ){
		 
		
		 
        $sql = mysqli_query( $this->conn ,"SELECT COUNT(id) as likes FROM `user_campaign_rel` where 	campaignid ='$comp_id'");

        return mysqli_fetch_assoc($sql);

    }
        
    //To get all session variables from one function call    
    function getAllUserInfo()
    {
        $temp_array = array();
        
        if($this->CheckLogin())
        {
            $sql = mysqli_query($this->conn ,"SELECT * FROM `register` where id = {$_SESSION['user_id']}");
            $result = $sql->fetch_assoc();
            $temp_array['user_id'] = $_SESSION['user_id'];
            $temp_array['type'] = $_SESSION['type'];
            $temp_array['user_email'] = $_SESSION['user_email'];
            $temp_array['user_name'] = $_SESSION['user_name'];
            $temp_array['community_points'] = $result['community_points'];
        }
        else
        {
            //nothing
        }
        
        return $temp_array;
    }
    
    //get all useful data for the profile page/homescreen
    function dataForProfilePage()
    {
        $result_array = array();
        if($this->CheckLogin())
        {
            //for payment info
            $payment_result = array();
            $userid = (int) $_SESSION['user_id'];
            $sql = mysqli_query($this->conn ,"SELECT * FROM `fundfolio_payments` WHERE userid = $userid AND payment_status = 'success'");
            while($row = mysqli_fetch_assoc($sql)) {
                $payment_result[] = $row;
            }
            
            //calculate total amount
            $result_array['total_donate'] = 0;
            $result_array['last_year_donate'] = 0;
            $result_array['last_6month_donate'] = 0;
            $result_array['last_month_donate'] = 0;
            $result_array['last_week_donate'] = 0;
            $result_array['folio_backed'] = array();
            $result_array['jsonTable'] = '';
            $arrayTable = array();
            
            $today_date = strtotime("-1 day");
            $last_week_date = strtotime("-1 week");
            $last_month_date = strtotime("-1 month");
            $last_6month_date = strtotime("-6 month");
            $last_year_date = strtotime("-1 year");
            
            /*var_dump($today_date);
            var_dump($last_week_date);
            var_dump($last_month_date);
            var_dump($last_6month_date);
            var_dump($last_year_date);
            echo "<br>===<br>";*/
            foreach($payment_result as $pr)
            {
                $createdtime = strtotime($pr['createdtime']);
                //var_dump($pr['payment_amount']);
                //var_dump($createdtime);
                //var_dump($createdtime >= $last_week_date);
                if($createdtime >= $last_year_date)
                {
                    if($createdtime >= $last_6month_date)
                    {
                        if($createdtime >= $last_month_date)
                        {
                            if($createdtime >= $last_week_date)
                            {
                                $result_array['last_week_donate'] += $pr['payment_amount'];
                            }
                            $result_array['last_month_donate'] += $pr['payment_amount'];
                        }
                        $result_array['last_6month_donate'] += $pr['payment_amount'];
                    }
                    $result_array['last_year_donate'] += $pr['payment_amount'];
                }
                $result_array['total_donate'] += $pr['payment_amount'];
                
                if(!in_array($pr['itemid'], $result_array['folio_backed']))
                {
                    $result_array['folio_backed'][] = $pr['itemid'];
                }
            }
            
            $arrayTable['cols'] = array(
                array('label' => 'Campaign Category', 'type' => 'string'),
                array('label' => 'Percentage', 'type' => 'number'),
                array('role' => 'tooltip', 'type' => 'string', 'p' => array('html'=> true))
            );
            
            $temp_campaign_array = $this->getCampaign(-1);
            $campaign_result = array();
            array_walk($temp_campaign_array, function($v, $k) use (&$campaign_result){ $campaign_result[$v['campaignid']] = $v; });
            
            $total_no_of_payments = 0;
            $no_of_payments_per_category = array();
            $no_of_payments_per_folio = array();
            
            foreach($payment_result as $pr)
            {
                $cat_type_name = $campaign_result[$pr['itemid']]['categorytype'];
                if(isset($campaign_result[$pr['itemid']]) && isset($no_of_payments_per_category[$cat_type_name]))
                {
                    $no_of_payments_per_category[$cat_type_name]['count'] += 1;
                    $no_of_payments_per_category[$cat_type_name]['donation'] += $pr['payment_amount'];
                }
                else if(isset($campaign_result[$pr['itemid']]))
                {
                    $no_of_payments_per_category[$cat_type_name]['count'] = 1;
                    $no_of_payments_per_category[$cat_type_name]['donation'] = $pr['payment_amount'];
                }
                $total_no_of_payments++;
                
                //project wise total
                if(isset($campaign_result[$pr['itemid']]) && isset($no_of_payments_per_folio[$campaign_result[$pr['itemid']]['campaignname']]))
                {
                    $no_of_payments_per_folio[$pr['itemid']] += $pr['payment_amount'];
                }
                else if(isset($campaign_result[$pr['itemid']]))
                    $no_of_payments_per_folio[$pr['itemid']] = $pr['payment_amount'];
            }
            
            $all_categories = $this->getAllCategory();
            foreach($all_categories as $cat_id=>$cat_val)
            {
                if(!isset($no_of_payments_per_category[$cat_val]))
                {
                    $no_of_payments_per_category[$cat_val]['count'] = 0;
                    $no_of_payments_per_category[$cat_val]['donation'] = 0;
                }
            }
            
            $result_array['no_of_payments_per_folio'] = $no_of_payments_per_folio;
            $result_array['campaign_array'] = $campaign_result;
            
            $temp_table_row = array();
            
            //echo "<pre>";
            //print_r($no_of_payments_per_category);
            //echo $total_no_of_payments;
            //exit;
            
            foreach($no_of_payments_per_category as $noppc_cattype=>$noppc_count) {
                $temp = array();
                $temp[] = array('v' => (string) $noppc_cattype); 
                $percentage = ($noppc_count['count']/$total_no_of_payments)*100;
                $temp[] = array('v' => $percentage);
                $temp[] = array('v' => (string) "<p style='font-size: 15px; padding: 5px;'>".$noppc_count['donation'].'$ ('.$percentage.'% of the total donation made in <b>'.$noppc_cattype.'</b> category!)</p>'); 
                $temp_table_row[] = array('c' => $temp);
            }
            $arrayTable['rows'] = $temp_table_row;
            
            
            
            //print_r($payment_result);
            //exit;
            $result_array['jsonTable'] = json_encode($arrayTable);
            
            
            //for xyz info
        }
        else
        {
            //nothing
        }
        return $result_array;
    }
    
    function createMatrix($amount)
    {
        $result_array = array();
        if($amount>2)
        {
            $temp_get_actual_range = 1;
            foreach(range($amount/2, 1) as $range)
            {
                $temp_get_actual_range = $range;
                if(($range/2)*($range+1) <= $amount)
                    break;
            }
            
            foreach(range(1, $temp_get_actual_range) as $range)
            {
                $result_array[$range] = '';
            }
            
        }
        else if($amount==1)
        {
            $result_array = array(1 => '');
        }
        
        return json_encode($result_array);
    }
    
    function getMatrixforthefolio($folio_id) //in chunks
    {
        $folio_id = (int) $folio_id;
        $sql = mysqli_query( $this->conn ,"SELECT * FROM `campaign_fund` WHERE campaignid = $folio_id");
        $temp_result = mysqli_fetch_assoc($sql);
        if(!empty($temp_result))
        {
            $matrix_array = json_decode($temp_result['matrix'], true);
            $n_x_n = 1;
            foreach(range(1, 100) as $range)
            {
                $n_x_n = $range;
                if(pow($range, 2) > count($matrix_array))
                {
                    break;
                }
            }
            return array_chunk($matrix_array, $n_x_n, true);
        }
        else
        {
            return array();
        }
    }
    
    function getDonationlist($folio_id)
    {
        //all users data
        $all_users = array();
        $sql = mysqli_query($this->conn ,"SELECT * FROM `register`");
        while($row = mysqli_fetch_assoc($sql)) {
            $all_users[$row['id']] = $row;
        }
        
        $total_donators = 0;
        $total_donations = 0;
        $needed_backers = 0;
        
        $folio_id = (int) $folio_id;
        $sql = mysqli_query( $this->conn ,"SELECT * FROM `campaign_fund` WHERE campaignid = $folio_id");
        $temp_result = mysqli_fetch_assoc($sql);
        $result_array = array();
        if(!empty($temp_result))
        {
            $matrix_array = json_decode($temp_result['matrix'], true);
            $needed_backers = count($matrix_array);
            
            foreach ($matrix_array as $donated_amount => $user_id)
            {
                if($user_id!="" && isset($all_users[$user_id]))
                {
                    $sql = mysqli_query( $this->conn ,"SELECT * FROM `fundfolio_payments` WHERE userid = $user_id AND payment_amount=$donated_amount AND payment_status='success'");
                    $result_payment = mysqli_fetch_assoc($sql);
                    
                    if($result_payment)
                    {
                        $total_donators++;
                        $total_donations+=$donated_amount;
                        
                        $datetime1 = new DateTime();
                        $datetime2 = new DateTime($result_payment['createdtime']);
                        $strtotime_for_sort = strtotime('now') - strtotime($result_payment['createdtime']); //used for sorting
                        $interval = $datetime1->diff($datetime2);
                        $elapsed_time = array();
                        $elapsed_time['seconds'] = $interval->format('%S');
                        $elapsed_time['minutes'] = $interval->format('%i');
                        $elapsed_time['hours'] = $interval->format('%h');
                        $elapsed_time['days'] = $interval->format('%a');
                        $elapsed_time['months'] = $interval->format('%m');
                        
                        $elapsed_show_string = $elapsed_time['months']>0 ? $elapsed_time['months'].' months ago' : ($elapsed_time['days']>0 ? $elapsed_time['days'].' days ago' : ($elapsed_time['hours']>0 ? $elapsed_time['hours'].' hours ago' : ($elapsed_time['minutes']>0 ? $elapsed_time['minutes'].' minutes ago' : $elapsed_time['seconds'].' seconds ago')));
                        
                        $result_array[] = array('amount'=>$donated_amount,'userid'=>$user_id, 'name'=>$all_users[$user_id]['name'], 'email'=>$all_users[$user_id]['email'], 'profilepic'=> $all_users[$user_id]['profilepic'], 'elapsed_time'=>$elapsed_time, 'elapsed_time_string'=>$elapsed_show_string, 'strtotime_for_sort' => $strtotime_for_sort);
                    }
                }
            }
        }
        
        //calculate % completed
        $folio_id = (int) $folio_id;
        $sql = mysqli_query( $this->conn ,"SELECT * FROM `campaign` WHERE campaignid = $folio_id");
        $temp_campaign_result = mysqli_fetch_assoc($sql);
        
        $percentage_completed = 0;
        if($temp_campaign_result)
            $percentage_completed = (100*$total_donations)/$temp_campaign_result['amount'];
        
        usort($result_array, function($a, $b){
          return $a['strtotime_for_sort'] - $b['strtotime_for_sort'];
        });
        
        return array('list'=>$result_array, 'progressbarinfo'=>array('needed_backers'=>$needed_backers, 'total_donators'=>$total_donators, 'total_donations'=>$total_donations, 'percentage_completed'=>$percentage_completed));
    }

    
    function getCampaignById($folio_id)
    {
        //calculate % completed
        $folio_id = (int) $folio_id;
        $temp_campaign_result = array();
        $sql = mysqli_query( $this->conn ,"SELECT c.*,r.* FROM `campaign` as c
		LEFT JOIN register as r ON r.id = c.loginid
		WHERE c.campaignid = $folio_id");
        if($sql->num_rows > 0)
            $temp_campaign_result = mysqli_fetch_assoc($sql);
        
        $user_info = $this->getAllUserInfo();
        $user_id = $user_info['user_id'];
        $sql = mysqli_query( $this->conn ,"SELECT has_liked, facebook_shared, twitter_shared FROM user_campaign_rel WHERE campaignid = $folio_id AND userid = $user_id");
        $temp_campaign_result2 = array();
        if($sql->num_rows > 0)
            $temp_campaign_result2 = mysqli_fetch_assoc($sql);
        return $temp_campaign_result + $temp_campaign_result2;
    }
    
    function updateFolioMatrix($folio_id, $amount, $userid)
    {
        $folio_id = (int) $folio_id;
        $amount = (int) $amount; //in our case amount is integer
        $sql = mysqli_query( $this->conn ,"SELECT * FROM `campaign_fund` WHERE campaignid = $folio_id");
        $temp_result = mysqli_fetch_assoc($sql);
        if(!empty($temp_result))
        {
            $matrix_array = json_decode($temp_result['matrix'], true);
            
            $checked_for_current = explode('_', $userid);
            $current_possible_userid = $userid;
            $current_possible_time = strtotime('now');
            if(count($checked_for_current)>1)
            {
                $current_possible_userid = $checked_for_current[1];
                $current_possible_time = $checked_for_current[2];
            }
            
            $check_for_saved = explode('_', $matrix_array[$amount]);
            $saved_possible_userid = $matrix_array[$amount];
            $saved_possible_time = '';
            if(count($check_for_saved)>1)
            {
                $saved_possible_userid = $check_for_saved[1];
                $saved_possible_time = $check_for_saved[2];
            }
            
            //main checkign conditiong ONLY ALLOW DIFFERENT USER IF TIME DIFFERENCE IS GREATER THAN 2 MINUTES
            $major_condition_flag = false; //if true then only update action is allowed
            $current_time = strtotime('now');
            if($saved_possible_time=='' || $saved_possible_userid=='')
            {
                $major_condition_flag = true;
            }
            else if($saved_possible_time!="" &&  $saved_possible_userid!='')
            {
                if($saved_possible_userid==$current_possible_userid)
                    $major_condition_flag = true;
                else if($current_possible_time - $saved_possible_time > 120) //seconds
                    $major_condition_flag = true;
                else
                    $major_condition_flag = false;
            }
            else
            {
                $major_condition_flag = true;
            }
            
            if($amount>0 && isset($matrix_array[$amount]) && $major_condition_flag) //real update
            {
               $matrix_array[$amount] = $userid;
            }
            else
            {
                return "InProcess";
            }
            $matrix_json = json_encode($matrix_array);
            
            $sql = mysqli_query( $this->conn , "UPDATE `campaign_fund` SET `matrix` = '".$matrix_json."' WHERE `campaign_fund`.`campaignid` = $folio_id;");
            if($sql)
                return "Success";
            else
                return "Error";
        }
        else
        {
            return "notfound";
        }
    }
    
    function addCampaignMatrix($campaignid, $amount)
    {
        $matrix_string = $this->createMatrix($amount);
        $query = "INSERT INTO `campaign_fund` (`id`, `campaignid`, `matrix`, `created_on`, `updated_on`) VALUES (NULL, '$campaignid', '$matrix_string', NOW(), NOW())";
        $flag = mysqli_query( $this->conn , $query );
    }
    
    function checkEmailForGoogleLogin($email)
    {
        $query = "SELECT * FROM `register` where email = '$email'";
        $result = mysqli_query( $this->conn, $query ) or die(mysqli_error($this->conn));
        if($result && mysqli_num_rows($result) > 0)
        {
            return true;
        }
    }
    
    function dynamicUserRegister()
    {
        
    }
    
    function addCommunityPoints($user_id, $amount)
    {
        $query = "SELECT * FROM `register` where id = '$user_id'";
        $result = mysqli_query( $this->conn, $query ) or die(mysqli_error($this->conn));
        if($result && mysqli_num_rows($result) > 0)
        {
            $result = $result->fetch_assoc();
            $current_points = $result['community_points'];
            $final_points = $current_points+$amount;
            $sql = mysqli_query( $this->conn , "UPDATE `register` SET `community_points` = $final_points WHERE id = $user_id;");
            if($sql)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    
    function addCampaignupdate($data)
    {
        if(($data['update_text']!="" || $data['update_iamge']!="" || $data['update_video']!="") && isset($_SESSION['user_id']))
        {
            $date = date('Y-m-d H:i:s');
            $query = "INSERT INTO `campaign_updates` (`id`, `userid`, `campaignid`, `update_text`, `update_image`, `update_video`, `created_on`) VALUES (NULL, '{$_SESSION['user_id']}', '{$data['campaignid']}', '{$data['update_text']}', '{$data['update_image']}', '{$data['update_video']}', '$date');";
            
            $sql = mysqli_query($this->conn, $query);
            $id = mysqli_insert_id( $this->conn);
            return $id;
        }
    }
    
    function getCampaignupdates($campaignid)
    {
        $campaign_result = array();
        $campaignid = (int) $campaignid;
        if($campaignid > 0 )
        {
            $query = "SELECT * FROM `campaign_updates` WHERE campaignid = ".(int)$campaignid;
            $sql = mysqli_query( $this->conn, $query ) or die(mysqli_error($this->conn));

            while($row = mysqli_fetch_assoc($sql)) {
                $campaign_result[$row['id']] = $row;
                $current_time = date('Y-m-d H:i:s');
                //calculation
                $elapsed_strtotime = strtotime($current_time) - strtotime($row['created_on']);
                $datetime1 = new DateTime($current_time);
                $datetime2 = new DateTime($row['created_on']);
                $interval = $datetime1->diff($datetime2);
                $elapsed_time = array();
                $elapsed_time['seconds'] = $interval->format('%S');
                $elapsed_time['minutes'] = $interval->format('%i');
                $elapsed_time['hours'] = $interval->format('%h');
                $elapsed_time['days'] = $interval->format('%a');
                $elapsed_time['months'] = $interval->format('%m');
                $elapsed_time_string = $elapsed_time['months']>0 ? $elapsed_time['months'].' months ago' : ($elapsed_time['days']>0 ? $elapsed_time['days'].' days ago' : ($elapsed_time['hours']>0 ? $elapsed_time['hours'].' hours ago' : ($elapsed_time['minutes']>0 ? $elapsed_time['minutes'].' minutes ago' : $elapsed_time['seconds'].' seconds ago')));
                
                $campaign_result[$row['id']]['time_elapsed_string'] = $elapsed_time_string;
                $campaign_result[$row['id']]['time_elapsed'] = $elapsed_strtotime;
            }

            arsort($campaign_result);

            return $campaign_result;
        }
    }
}
