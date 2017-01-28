

<?php
error_reporting(E_ERROR);
	
		$cat_id = -1;
		// Include Functions
		include_once("functions.php");	
		$db = new DBController();
                
                $profilepage_info = ($db->dataForProfilePage());
                $user_info = ($db->getAllUserInfo());
		
		if(! $db -> CheckLogin()){
			 header("Location: /index.php");
							die();
			
		}
		
		
		function sortArrayKeyWise( $arrray , $sort_key ){
			
			
				$arr  = $arrray;
				$sort = array();
				foreach($arr as $k=>$v) {
					$sort[$sort_key][$k] = $v[$sort_key];
				}

				array_multisort($sort[$sort_key], SORT_DESC, $arr);

				/* echo "<pre>";
				print_r($arr);
				
				exit; */
				return  $arr;
			
			
		}
		
		
		 if( isset( $_REQUEST [ 'action_logout' ] )){

				 $db -> LogOut();
				  header("Location: /index.php");
		} 
		
		
		
		
		
		if( isset ( $_REQUEST['cat_id'] ) ){
			
			//echo
			$cat_id =$_REQUEST['cat_id'];
			$campaign_list_main = $db -> getCampaign(  $_REQUEST['cat_id'] );
		}
		else{
			
			//echo " not set " ;
			$campaign_list_main = $db -> getCampaign(-1);
		}
		
		if( isset ( $_REQUEST['user_id'] ) ){
			$user_id = $_REQUEST['user_id'] ;
		}
		
		$campaign_list = array();
		
		if( isset ( $_REQUEST['cat_id_le'] ) ){
			
			$cat_id_le = $_REQUEST['cat_id_le'] ;
			
			
			if($cat_id_le == 11){
				foreach( $campaign_list_main as $campaign ){
					
					$likes = $db->getCampaignLike($campaign['campaignid'] );

					
					$campaign['likes'] = $likes['likes'];
					$campaign_list[] = $campaign;
					
					/* if($campaign['monthly_charity'] == 1  ){
						$campaign_list[] = $campaign;
					} */
					
				}
				
				$campaign_list = sortArrayKeyWise( $campaign_list , 'likes' );
				
				
			}
			else if($cat_id_le == 12){
				foreach( $campaign_list_main as $campaign ){
					
					if($campaign['staff_picks'] == 1  ){
						$campaign_list[] = $campaign;
					}
					
				}
			}
			else if($cat_id_le == 13){
				foreach( $campaign_list_main as $campaign ){
					$donation_info = ($db->getDonationlist($campaign['campaignid']));
					
					/* print_r($donation_info) ;
					echo '<br/>';
					echo $campaign['amount'];
					
					echo "shahid"; */
					
					if( ($campaign['amount'] - $donation_info['total_donations'] ) > 0  ){
						
						$campaign['isfunded'] = $donation_info['total_donations'];
						$campaign_list[] = $campaign;
						
					}
					
				}
				$campaign_list = sortArrayKeyWise( $campaign_list , 'isfunded' );
				//print_r( $campaign_list);
			}
			else if($cat_id_le == 14){
				foreach( $campaign_list_main as $campaign ){
					
					if($campaign['monthly_charity'] == 1  ){
						$campaign_list[] = $campaign;
					}
					
				}
			}
			else if($cat_id_le == 15){
				foreach( $campaign_list_main as $campaign ){
					
					if($campaign['company_location'] == $db ->  UserLocation()  ){
						$campaign_list[] = $campaign;
					}
					
				}
			}
			
			else if($cat_id_le == 16){
				foreach( $campaign_list_main as $campaign ){
					
					$location =  $_REQUEST['location'];
					
					if($campaign['company_location'] == $location  ){
						$campaign_list[] = $campaign;
					}
					
				}
			}
			
			
		}
		else{
			$campaign_list =  $campaign_list_main;
		}
		



?>
<html lang="en">
<head>
    <title>Fundfolio</title>
    <meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->

    <!-- Compiled and minified CSS -->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>

    <!-- Compiled and minified JavaScript -->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    
    <script type="text/javascript" src="jquery-ui-1.12.0/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    

    <link rel="stylesheet" href="homescreen.css">
    <link rel="stylesheet" href="homescreen1.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="jquery-ui-1.12.0/jquery-ui.min.css">
    <!--media="screen and (min-width: 1740px)"-->
    <link rel="stylesheet" href="homescreen-medium.css" media="screen and (max-width: 1360px)">
</head>

<style>
    .row .col.s3 {
        width: 24% !important;
    }
</style>

<body>
    <div id="view_history_popup" style='display:none;' title="History of Donations">
        <table style='border: none;' cellspacing="10" cellpadding="5">
            <th>Campaign Name</th>
            <th>Donation</th>
            <?php
                foreach($profilepage_info['no_of_payments_per_folio'] as $folio_id=>$folio_fund)
                {
                    $folio_name = $profilepage_info['campaign_array'][$folio_id]['campaignname'];
                    ?>
                    <tr>
                        <td>
                            <?php echo "<a style='text-decoration: underline !important;' href='usercampaign.php?folio_id=".$folio_id."'>$folio_name</a>"; ?>
                        </td>
                        <td>
                            <?php echo "$".number_format($folio_fund); ?>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
    <div id="set_auto_back_popup" style='display:none;' title="Set Auto Back">
        <h5>Coming soon in beta release.</h5>
    </div>
    <div id="exchange_community_points_popup" style='display:none;' title="Exchange Community Points">
        <h3><?php echo !empty($user_info['community_points']) ? number_format($user_info['community_points']) : 0; ?></h3>
    </div>
    <div>
        
        <!--Top menu-->
        <header class="row" style="margin: 0">
            <div class="col s3" style="margin-top: 40px; margin-bottom: 20px; margin-left: 70px">
                <img src="images/logo1.png" style="width: 70%;">
            </div>
            <div class="row col s5" style="float: right; margin-top: 40px; height: 50px; line-height: 50px; text-align: center">
													
                <div class="col s3" style="text-align: center;" >
                    <!--<img src="images/background.png" style="border-radius: 50%; height: 50px; width: 50px"-->					  
					 <img onerror="this.src='images/userimagenotfound.png'" src="profile_uploads/<?php echo $db -> UserImage() ; ?>" src="profile_uploads/<?php echo $db -> UserImage() ; ?>" style="border-radius: 50%; height: 50px; width: 50px"/>					
                </div>
				<div class="col s3" style="text-align: center;" >
				     <a href="?action_logout=logout" class="button user-name text-center text-uppercase" style="border: 2px solid black;">LogOut </a>
				</div>
                <div class="col s5" style="text-align: center;">
                    WELCOME, <b><?php 
				/* if(  $db ->  UserType() == 0){
					echo $db ->  UserEmail() ;
				}
				else if(  $db ->  UserType() == 1 ) */ {
					echo $db ->  UserName() ;
				}
				
				?></b>
                </div>
            </div>
        </header>

        <div id="main_content">
            <div class="row" style="margin-left: 50px;">
                <!--<a href="#">-->
                    <div id="card1" class="col s7" style="position: relative">
                        <!--<div style="font-size: 6vh; font-weight: bolder; color: white; position: absolute; top: 40%; left: 35%">-->
                            <!--Launch a Folio-->
                        <!--</div>-->
                        <img src="images/card1.png" style="height: 100%; width: 100%" onClick="document.location.href='HTML/'" >
                    </div>
                <!--</a>-->

                <!--<a href="#">-->
                    <div id="card2" class="col s4">
                        <div style="margin-top: 25%; position: relative">
                            <div class="row" style="font-size: 25px; font-weight: bolder; color: white; height: 25px;">
                                <?php echo !empty($user_info['community_points']) ? number_format($user_info['community_points']) : 0; ?>
                            
                                Community Points
                            </div>
                            <div style="font-size: 25px; font-weight: bolder; color: white; text-align: left; position: absolute; left: 30%">
                                <div class="row" style="margin-top: 30%; margin-bottom: 0; position: relative">
                                    <div class="col s1" style="width: 15px; height: 15px; background-color: white; padding: 0; position: absolute; top: 30%"></div>
                                    <div class="col s11" style="margin-left: 40px; padding: 0;">Donate to a folio</div>
                                </div>
                                <div class="row" style="margin-bottom: 0; position: relative">
                                    <div class="col s1" style="width: 15px; height: 15px; background-color: white; padding: 0; position: absolute; top: 30%"></div>
                                    <div class="col s11" style="margin-left: 40px; padding: 0">Share on Social</div>
                                </div>
                                <div class="row" style="margin-top: 0; position: relative">
                                    <div class="col s1" style="width: 15px; height: 15px; background-color: white; padding: 0; position: absolute; top: 30%"></div>
                                    <div class="col s11" style="margin-left: 40px; padding: 0">Like a Campaign</div>
                                </div>
                            </div>
                        </div>
                        <!--<img src="images/card2.png" style="height: 100%; width: 100%">-->
                    </div>
                <!--</a>-->
            </div>
			
            <div class="row" style="margin-top: 40px; margin-left: 50px; margin-bottom: 0px">
                				
                    <!--<a href="#">-->
                        <div id="card3" class="col s4" style="position: relative; width: 28%;">
                            <div style="font-size: 20px; font-weight: bolder; color: white; top: 40%; position: absolute; left: 15%">
                                <div class="row" style="margin-bottom: 0px">
                                    <div class="col s12" style="text-align: right; padding: 0px">
                                        <?php echo !empty($profilepage_info['total_donate']) ? $profilepage_info['total_donate'] : 0; ?> Total Donated
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12" style="text-align: right; padding: 0px">
                                        <?php echo !empty($profilepage_info['folio_backed']) ? count($profilepage_info['folio_backed']) : 0; ?> Folios Backed
                                    </div>
                                </div>
                            </div>
                            <!--<img src="images/card3.png" style="width: 100%; height: 100%">-->
                        </div>
                    <!--</a>-->				
																			
                    <!--<a href="#">-->
                        <div id="card4" class="col s4"  style="width: 28%; height: 100%;">
                            <!--<div style="color: white; font-weight: bolder; font-size: 35px; position: absolute; top: 45%; left: 30%">-->
                                <!--My Fundfolio-->
                            <!--</div>-->
                            <img src="images/card4.png" style="height: 100%; width: 100%"/>
                        </div>
                    <!--</a>-->
                					
                    <!--<a href="#">-->
                    <div id="card5" class="col s4" style="width: 29%; height: 100%;">
                        <!--<div style="color: white; font-weight: bolder; font-size: 35px; position: absolute; top: 45%; left: 35%">-->
                            <!--Help Center-->
                        <!--</div>-->
                        <img src="images/card5.png" style="height: 100%; width: 100%"/>
                    </div>
                <!--</a>-->
            </div>
        </div>

        <div id="backed_panel">
            <div class="red-x big-x close" style="float: right; margin: 30px">&#10006;</div>
            <div class="container-fluid">
                <div class="row top-margin left-margin">
                    <div class="col s4">
                        <div class="small-font">
                            Account Number #XYZ
                        </div>
                        <div class="medium-font">
                            Total Donated $<?php echo !empty($profilepage_info['total_donate']) ? number_format($profilepage_info['total_donate']) : 0; ?>
                        </div>
                    </div>
                    <div id="exchange_community_points" class="col s3 offset-s4 left-align small-font" style="cursor: pointer">
                        <span><img src="images/exchange_icon.png" width="30px" height="30px"></span>
                        <span class="top-align">Exchange Community Points</span>
                    </div>
                </div>
            </div>
            <div class="container-fluid extra-margin">
                <div class="row" style="margin: 0">
                    <div class="col s4 side-details top-margin" style="padding-bottom: 30px;">
                        <div>
                            <div class="small-font">
                                Year to Date
                            </div>
                            <div class="medium-font">
                                $<?php echo !empty($profilepage_info['last_year_donate']) ? number_format($profilepage_info['last_year_donate']) : 0; ?>
                            </div>
                        </div>
                        <div class="top-margin-small">
                            <div class="small-font">
                                6 Months
                            </div>
                            <div class="medium-font">
                                $<?php echo !empty($profilepage_info['last_6month_donate']) ? number_format($profilepage_info['last_6month_donate']) : 0; ?>
                            </div>
                        </div>
                        <div class="top-margin-small">
                            <div class="small-font">
                                Month to Date
                            </div>
                            <div class="medium-font">
                                $<?php echo !empty($profilepage_info['last_month_donate']) ? number_format($profilepage_info['last_month_donate']) : 0; ?>
                            </div>
                        </div>
                        <div class="top-margin-small">
                            <div class="small-font">
                                Week to Date
                            </div>
                            <div class="medium-font">
                                $<?php echo !empty($profilepage_info['last_week_donate']) ? number_format($profilepage_info['last_week_donate']) : 0; ?>
                            </div>
                        </div>
                        <div class="top-margin-small">
                            <div class="small-font">
                                Community Points
                            </div>
                            <div class="medium-font">
                                <?php echo !empty($user_info['community_points']) ? number_format($user_info['community_points']) : 0; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col s8" style="padding: 0; position: relative">
<!--                        <div class="opacity">
                            <div class="vertical-center">
                                <div class="center-content">
                                    <img src="images/smiley.png">
                                </div>
                                <div class="center-content medium-font" style="margin-top: 30px">
                                    See what you are interested in!
                                </div>
                                <div class="center-content" style="margin-top: 30px">
                                    <button class="btn">Click to Generate</button>
                                </div>
                            </div>
                        </div>-->
                        <div class="charts" id='chart_div' style="width: 90%; height: 20%;">
                           <div class="container-fluid" style="margin: 8% 50px">
                                <div class="row">
                                    <div class="col s12">
                                        <img src="images/chart.png" width="100%" height="auto">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id='set_auto_back' class="col s4 button-style" style='cursor:pointer'>
                        <img class="img-center" src="images/set_auto.png" width="40px" height="auto"><span>Set Auto Back</span>
                    </div>
                    <div class="col s4 button-style">
                        <img src="images/browser.png" width="40px" height="auto" style="margin: -5px 10px;"><span>Browse Projects</span>
                    </div>
                    <div id='view_history' class="col s4 button-style" style='cursor:pointer'>
                        <img class="img-center" src="images/view_history.png" width="40px" height="auto"><span>View History</span>
                    </div>
                </div>
            </div>
        </div>

        <div id="fundfolio_panel" class="row" style="display: <?php echo isset( $_SESSION['user_id']) ? 'block' : 'none';?>">
            <div class="red-x big-x close" style="float: right; margin: 10px">&#10006;</div>
			
			
			<?php 
			
			if( isset( $_SESSION['user_id']) ){
			
				$user_campaign =  $db -> getCampaignByUser(  $_SESSION['user_id'] );
			
				//print_r( $user_campaign );
				
				
				$date = date('Y-m-d H:i:s');

				
				if( count($user_campaign) == 0 ){
					echo "<h4>No Projects found</h4>";
				}
				

				//$len = count($campaign_list);
				foreach( $user_campaign as $campaign ){
                                 
                                 
				 $donation_info = ($db->getDonationlist($campaign['campaignid']));
                                 $progressbar_info = $donation_info['progressbarinfo'];
					
				 $startTimeStamp = strtotime( $campaign['c_date']);
				 $endTimeStamp = strtotime( $date );

				 $timeDiff = abs($endTimeStamp - $startTimeStamp);

				 $numberDays = $timeDiff/86400;  // 86400 seconds in one day

				// and you might want to convert to integer
				 $numberDays = intval($numberDays);
				 $numberDays = $campaign['days'] - $numberDays ; 
				 if( $numberDays < 0 )
					 $numberDays = 0;
				 if( $campaign['amount'] != 0 )
				 $percent = ( $campaign['total_amount']/$campaign['amount'] ) * 100;
				 else {
					 
				 }
				 //determinate
				 //echo "   ". $numberDays;
					
				?>
				
				
				
				 <!--Campaign Content 1-->
				 <div class="col s3" style="margin-left: 0px; margin-top: 50px;">
                    <a href="usercampaign.php?folio_id=<?php echo $campaign['campaignid'];  ?>">
                        <div class="card" style="margin: 0px; border-radius: 0px;height: 475px;">
                            <!--img src="images/campaign1.png" alt="Avatar" style="width:100%"-->
							<img src="campaign_uploads/<?php echo $campaign['campaignimage'];  ?>" alt="Avatar" onerror="this.src='campaign_uploads/imagenotfound.jpg'" style="width:100%">
                            <div class="container1" style="height:auto;">
                                <h5><b><?php  echo $campaign['campaignname']; ?></b></h5>
                                <p style="overflow: hidden; word-break: break-all;"><?php  echo $campaign['description']; ?></p>
								<p><a href="usercampaign.php?folio_id=<?php echo $campaign['campaignid'];  ?>" style="color:orange;">Read more</a></p>
                                <div class="row">
                                    <img class="col s2" src="images/location.png" style="padding: 0; height: auto; width: 20px;">
                                    <h5 class="col s9"><?php  echo $campaign['company_location']; ?></h5>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="progress" style="margin: 0px">
                        <div class="determinate" style="width: <?php echo $progressbar_info['percentage_completed']; ?>%"></div>
                    </div>
					
					
                    <div class="row campaign_details" style="background-color: #F9F9F9; color: #76777B; border-radius: 0px 0px 5px 5px;">
                        <div class="col s4">
                            <h5><?php echo $progressbar_info['total_donators']; ?> of <?php  echo $progressbar_info['needed_backers']; ?></h5>
                            <p>Backers</p>
                        </div>
                        <div class="col s4">
                            <h5> <?php echo $campaign['amount'];  ?>$ </h5>
                            <p>Goal</p>
                        </div>
                        <div class="col s4">
                            <h5> <?php  echo /* $campaign['days'] */$numberDays; ?> days</h5>
                            <p>open folio</p>
                        </div>
                    </div>
                </div>
				
				<?php } 

				}
				
			
				?>
				
				
				
				
				
				
			
        </div>

        <div id="help_center_panel">
            <div class="red-x big-x close" style="float: right; margin: 30px">&#10006;</div>
            <div style="color: white; text-align: center; font-size: 60px; font-weight: bolder; margin-top: 100px">
                Welcome to your FolioDesk
            </div>
            <div style="color: white; text-align: center; font-size: xx-large;">
                The effortless helpdesk support for fundfolio
            </div>
            <div class="row" style="margin-bottom: 0">
                <div class="col s6 offset-s2" style="margin-top: 50px;">
                    <input type="text" placeholder="How do we help?" style="border: 0; padding-left: 50px; padding-right: 0px; font-size: x-large; background-color: white; height: 80px">
                </div>
                <div class="col s2" style="margin-top: 50px;">
                    <button  style="color: white;width: 100%; height: 80px; background-color: rgb(73,140,101); font-size: x-large; border: 0px">Send</button>
                </div>
            </div>
            <div class="row">
                <div class="col offset-s2" style="color: white; font-size: large;">
                    <p style="margin: 0">Trending searches: collecting payments, social sharing</p>
                </div>
            </div>
        </div>

        <div class="row" style="position: relative; margin-bottom: 0">

            <!--Horizontal Navigation Bar-->
            <nav id="site">
                <div class="nav-wrapper">
                    <ul id="nav-mobile" class="left hide-on-med-and-down" style="width: 100%;">
					
					 <!--<div class="col s1 offset-s2">-->
                        <li style=" font-size: 16px;" <?php  if ( $cat_id == -1 ) { ?> class="active" <?php  } ?> ><a href="?cat_id=-1">OVERVIEW</a></li>
                        <!--</div>-->
                        <!--<div class="col s1">-->
                        <li  <?php  if ( $cat_id == 1 ) { ?> class="active" <?php  } ?> ><a href="?cat_id=1">Business</a></li>
                        <!--</div>-->
                        <!--<div class="col s1">-->
                        <li <?php  if ( $cat_id == 2 ) { ?> class="active" <?php  } ?> ><a href="?cat_id=2">Travel</a></li>
                        <!--</div>-->
                        <!--<div class="col s1">-->
                        <li <?php  if ( $cat_id == 3 ) { ?> class="active" <?php  } ?> ><a href="?cat_id=3">Sports</a></li>
                        <!--</div>-->
                        <!--<div class="col s1">-->
                        <li <?php  if ( $cat_id == 4 ) { ?> class="active" <?php  } ?> ><a href="?cat_id=4">Health</a></li>
                        <!--</div>-->
                        <!--<div class="col s1">-->
                        <li <?php  if ( $cat_id == 5 ) { ?> class="active" <?php  } ?> ><a href="?cat_id=5">Philanthropy</a></li>
                        <!--</div>-->
                        <!--<div class="col s1">-->
                        <li <?php  if ( $cat_id == 6 ) { ?> class="active" <?php  } ?> ><a href="?cat_id=6">Arts</a></li>
                        <!--</div>-->
						  <!--<div class="col s1">-->
                        <li <?php  if ( $cat_id == 7 ) { ?> class="active" <?php  } ?> ><a href="?cat_id=7">Journalism</a></li>
                        <!--</div>-->
						  <!--<div class="col s1">-->
                        <li <?php  if ( $cat_id == 8 ) { ?> class="active" <?php  } ?> ><a href="?cat_id=8">Pets & Animals</a></li>
                        <!--</div>-->
						  <!--<div class="col s1">-->
                        <li <?php  if ( $cat_id == 9 ) { ?> class="active" <?php  } ?> ><a href="?cat_id=9">Education</a></li>
                        <!--</div>-->
                       
                    </ul>
                </div>
            </nav>

            <a class="btn btn-lg btn-success" id="big-sexy" onclick="togglenav()"><i class="material-icons">menu</i></a>

            <div id="site-menu">
                <!--<a class="btn btn-lg btn-success" onclick="togglenav()" style="color: pink; font-size: 20px;"><i class="fa fa-times"></i></a>-->
                <ul>				
				    <li class="active"><a href="?cat_id =-1">OVERVIEW</a></li>
                    <li style="font-size: large;"><a href="?cat_id =1" style="font-size: large;">Business</a></li>
                    <li><a href="?cat_id =2" style="font-size: large;">Travel</a></li>
                    <li><a href="?cat_id =3" style="font-size: large;">Sports</a></li>
                    <li><a href="?cat_id =4" style="font-size: large;">Health</a></li>
                    <li><a href="?cat_id =5" style="font-size: large;">Philanthropy</a></li>
                    <li><a href="?cat_id =6" style="font-size: large;">Arts</a></li>
					<li><a href="?cat_id =7" style="font-size: large;">Journalism</a></li>
                    <li><a href="?cat_id =8" style="font-size: large;">Pets & Animals</a></li>
					<li><a href="?cat_id =9" style="font-size: large;">Education</a></li>
					
                </ul>
            </div>

        </div>

        <div style="margin-bottom: 100px;">
            <div class="row">

                <!--Side Navigation Bar-->
                <div class="col s3">
                    <div id="sidenavbar" style="margin-top: 50px; margin-left: 20px; background-color: #F9F9F9">
                        <ul style="margin-left: 20px">
                            <li <?php  if ( $cat_id_le == 10 ) { ?> class="active" <?php  } ?> onclick = "document.location.href='?cat_id=<?php echo $cat_id; ?>&cat_id_le=10'" >
                                <label style="color: #545557; font-weight: bold; font-size: medium">TRENDING NOW</label>
                            </li>
                            <li <?php  if ( $cat_id_le == 11 ) { ?> class="active" <?php  } ?> onclick = "document.location.href='?cat_id=<?php echo $cat_id; ?>&cat_id_le=11'"  >
                                <img src="images/star.png" style="width: 20px; height: 20px;">
                                <a>Popular</a>
                            </li>
                            <li <?php  if ( $cat_id_le == 12 ) { ?> class="active" <?php  } ?> onclick = "document.location.href='?cat_id=<?php echo $cat_id; ?>&cat_id_le=12'" >
                                <img src="images/staff.png" style="width: 20px; height: 20px;">
                                <a>Staff Picks</a>
                            </li>
                            <li <?php  if ( $cat_id_le == 13 ) { ?> class="active" <?php  } ?> onclick = "document.location.href='?cat_id=<?php echo $cat_id; ?>&cat_id_le=13'" >
                                <img src="images/eye.png" style="width: 20px; height: 13px;">
                                <a>Almost there</a>
                            </li>
                            <li  <?php  if ( $cat_id_le == 14 ) { ?> class="active" <?php  } ?> onclick = "document.location.href='?cat_id=<?php echo $cat_id; ?>&cat_id_le=14'" >
                                <img src="images/heart.png" style="width: 20px; height: 22px;">
                                <a>Monthly Charity</a>
                            </li>
                            <li <?php  if ( $cat_id_le == 15 ) { ?> class="active" <?php  } ?> onclick = "document.location.href='?cat_id=<?php echo $cat_id; ?>&cat_id_le=15'"  >
                                <img src="images/location.png" style="width: 20px; height: 25px;">
                                <a>Near Me</a>
                            </li>
                        </ul>
                    </div>

                    <!--Search by location button-->
                    <div class="row" id = "div_show" onclick = "showSearchBox();"  style="margin-top: 0px; margin-left: 20px;">
                        <button id="search_btn">
                            <div style="float: left; margin-left: 20px; font-size: large">Search By Location</div>
                            <img src="images/downarrow.png"; style="float: right; width: 23px; height: 13px; margin-top: 5px; margin-right: 20px">
                        </button>
                    </div>
					
					<div class="row">
                       <input type = "text" placeholder="Ex. Indianapolis, United States" id = "loc_name" name = "loc_name" style="visibility: hidden;" />
                    </div>

                    <!--Tag-->
                    <div class="row col s2">
                        <img src="images/tag1.png" style="width: 250px; height: 40px; margin-left: 40px; margin-top: 20px;">
                    </div>
                </div>
				
				<div class="col s9">
				<?php 
				
				$date = date('Y-m-d H:i:s');

				
				if( count($campaign_list) == 0 ){
					echo "<h4>No Projects found</h4>";
				}
				

				//$len = count($campaign_list);
				foreach( $campaign_list as $campaign ){
                                 
                                 
				 $donation_info = ($db->getDonationlist($campaign['campaignid']));
                                 $progressbar_info = $donation_info['progressbarinfo'];
					
				 $startTimeStamp = strtotime( $campaign['c_date']);
				 $endTimeStamp = strtotime( $date );

				 $timeDiff = abs($endTimeStamp - $startTimeStamp);

				 $numberDays = $timeDiff/86400;  // 86400 seconds in one day

				// and you might want to convert to integer
				 $numberDays = intval($numberDays);
				 $numberDays = $campaign['days'] - $numberDays ; 
				 if( $numberDays < 0 )
					 $numberDays = 0;
				 if( $campaign['amount'] != 0 )
				 $percent = ( $campaign['total_amount']/$campaign['amount'] ) * 100;
				 else {
					 
				 }
				 //determinate
				 //echo "   ". $numberDays;
					
				?>
				
				
				  <!--Campaign Content 1-->
				 <div class="col s4" style="margin-left: 0px; margin-top: 50px;">
				                     <a href="usercampaign.php?folio_id=<?php echo $campaign['campaignid'];  ?>">
                        <div class="card" style="height: 380px;">
                            <!--img src="images/campaign1.png" alt="Avatar" style="width:100%"-->
							<img src="campaign_uploads/<?php echo $campaign['campaignimage'];  ?>" alt="Avatar" onerror="this.src='campaign_uploads/imagenotfound.jpg'" style="width:100%">
                            <div class="container1" style="height:auto;">
                                <h5><b><?php  echo $campaign['campaignname']; ?></b></h5>
                                <p style="word-break: break-all; overflow-y: auto; height: 70px; color: gray;"><strong><?php  echo $campaign['description']; ?></strong></p>
							
                                <img class="col s2" src="images/location.png" style="padding: 0; height: auto; width: 20px;"/>
                                <h5 class="col s9"><?php  echo $campaign['company_location']; ?></h5>
                                </div>                            
                        </div>
                    </a>
                    <div class="progress">
                        <div class="determinate" style="width: <?php echo $progressbar_info['percentage_completed']; ?>%"></div>
                    </div>
					
					
                    <div class="row campaign_details" style="background-color: #F9F9F9; color: #76777B">
                        <div class="col s4">
                            <h5><?php echo $progressbar_info['total_donators']; ?> of <?php  echo $progressbar_info['needed_backers']; ?></h5>
                            <p>Backers</p>
                        </div>
                        <div class="col s4">
                            <h5> <?php echo $campaign['amount'];  ?>$ </h5>
                            <p>Goal</p>
                        </div>
                        <div class="col s4">
                            <h5> <?php  echo /* $campaign['days'] */$numberDays; ?> days</h5>
                            <p>open folio</p>
                        </div>
                    </div>
                </div>
				
				<?php } ?>
				</div>

                <!--Campaign Content 1-->
               <!-- <div class="col s3" style="margin-left: 0px; margin-top: 50px">
                    <a href="#">
                        <div class="card" style="">
                            <img src="images/campaign1.png" alt="Avatar" style="width:100%">
                            <div class="container1">
                                <h5><b>Mission trip to Africa</b></h5>
                                <p>Vut perspiciatis unde omnis iste natus error sit voluptatem acc</p>
                                <div class="row">
                                    <img class="col s2" src="images/location.png" style="padding: 0; height: 30px; width: 20px;">
                                    <h5 class="col s9">Indianapolis, IN</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="progress">
                        <div class="determinate" style="width: 30%"></div>
                    </div>
                    <div class="row campaign_details" style="background-color: #F9F9F9; color: #76777B">
                        <div class="col s4">
                            <h5>16 of 24</h5>
                            <p>Backers</p>
                        </div>
                        <div class="col s4">
                            <h5>$300</h5>
                            <p>Goal</p>
                        </div>
                        <div class="col s4">
                            <h5>14 days</h5>
                            <p>open folio</p>
                        </div>
                    </div>
                </div> -->

                <!--Campaign Content 2-->
                <!--<div class="col s3" style="margin-left: 0px; margin-top: 50px">
                    <a href="#">
                        <div class="card">
                            <img src="images/campaign2.png" alt="Avatar" style="width:100%">
                            <div class="container1">
                                <h5><b>Race for Recovery</b></h5>
                                <p>Vut perspiciatis unde omnis iste natus error sit voluptatem acc</p>
                                <div class="row">
                                    <img class="col s2" src="images/location.png" style="padding: 0; height: 30px; width: 20px;">
                                    <h5 class="col s9">Chicago, IL</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="progress">
                        <div class="determinate" style="width: 50%"></div>
                    </div>
                    <div class="row campaign_details" style="background-color: #F9F9F9; color: #76777B">
                        <div class="col s4">
                            <h5>42 of 24</h5>
                            <p>Backers</p>
                        </div>
                        <div class="col s4">
                            <h5>$1000</h5>
                            <p>Goal</p>
                        </div>
                        <div class="col s4">
                            <h5>8 days</h5>
                            <p>open folio</p>
                        </div>
                    </div>
                </div> -- >

                <!--Campaign Content 3-->
              <!--  <div class="col s3" style="margin-left: 0px; margin-top: 50px">
                    <a href="#">
                        <div class="card">
                            <img src="images/campaign3.png" alt="Avatar" style="width:100%">
                            <div class="container1">
                                <h5><b>Avon steps</b></h5>
                                <p>Vut perspiciatis unde omnis iste natus error sit voluptatem acc</p>
                                <div class="row">
                                    <img class="col s2" src="images/location.png" style="padding: 0; height: 30px; width: 20px;">
                                    <h5 class="col s9">West Avon, IN</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="progress">
                        <div class="determinate" style="width: 80%"></div>
                    </div>
                    <div class="row campaign_details" style="background-color: #F9F9F9; color: #76777B">
                        <div class="col s4">
                            <h5>31 of 24</h5>
                            <p>Backers</p>
                        </div>
                        <div class="col s4">
                            <h5>$800</h5>
                            <p>Goal</p>
                        </div>
                        <div class="col s4">
                            <h5>3 days</h5>
                            <p>open folio</p>
                        </div>
                    </div>
                </div> -- >
            </div>
        </div>


        <!--Footer-->
        
    </div>
        </div>
		<footer class="page-footer" style="background-color: #F9F9F9">
            <div class="container">
                <div id="footer_links" class="row">
                    <div class="col s1">
                        <a href="#">About</a>
                    </div>
                    <div class="col s1">
                        <a>Jobs</a>
                    </div>
                    <div class="col s1">
                        <a>Press</a>
                    </div>
                    <div class="col s1">
                        <a>Help Center</a>
                    </div>
                    <div class="col s1">
                        <a>Get Started</a>
                    </div>
                    <div class="col s1">
                        <a>Handbook</a>
                    </div>
                    <div class="col s2" style="margin-left: 5%">
                        <input type="text" placeholder="Email Address" style="background-color: white; padding-left: 15px; border: 0;height: 40px; width: 300px; ">
                    </div>
                    <div class="col s2">
                        <button style="background-color: #4276E2; width: 150px; height: 40px; color: white; font-size: large; border-radius: 2px; padding: 0; border: 0; margin-left: 30px">Stay Connected</button>
                    </div>
                </div>
                <div id="footer_copyright" class="row">
                    <div class="col s3" style="color: #BABABA; padding: 0">
                        © 2016 Fundfolio Crowdfunding Company
                    </div>
                    <div class="col s1">
                        <a>Privacy</a>
                    </div>
                    <div class="col s1">
                        <a>Terms</a>
                    </div>
                    <div class="col s2">
                        <a>Safety and Use</a>
                    </div>
                    <div class="col s1 offset-l1" style="width: 50px">
                        <img src="images/hand1.png" style="width: 25px; height: 29px">
                    </div>
                    <div class="col s1" style="width: 50px">
                        <img src="images/twitter1.png" style="width: 27px; height: 25px">
                    </div>
                    <div class="col s1" style="width: 50px">
                        <img src="images/facebook1.png" style="width: 12px; height: 25px">
                    </div>
                    <div class="col s1" style="width: 50px">
                        <img src="images/instagram1.png" style="width: 25px; height: 25px">
                    </div>
                    <div class="col s1" style="width: 50px">
                        <img src="images/youtube1.png" style="width: 27px; height: 25px">
                    </div>
                    <div class="col s1" style="width: 70px">
                        <button class='dropdown-button btn' href='#' data-activates='dropdown1' style="background-color: transparent; color: #F9F9F9">
                            <a style="float: left">English</a>
                            <img src="images/downarrow.png"; style="float: right; width: 23px; height: 13px; margin-top: 5px; margin-right: 10px">
                        </button>
                        <ul id='dropdown1' class='dropdown-content'>
                            <li><a href="#!">English</a></li>
                            <li><a href="#!">Spanish</a></li>
                            <li class="divider"></li>
                            <li><a href="#!">German</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>

        </div>
    </div>
	
	
 <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyCgwupCCqrpms0vsY6k4ijoVEeGgNZQnZs&language=en-AU"></script>
        <script>
            var autocomplete = new google.maps.places.Autocomplete($("#loc_name")[0], {});

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
				
				
				var loc_n = document.getElementById("loc_name");
				//alert("its call"+loc_n.value);
				
				document.location.href='?cat_id=<?php echo $cat_id; ?>&cat_id_le=16&location='+loc_n.value;
				
                console.log(place.address_components);
            });
        </script>

    <script type="text/javascript">
        $(function () {
            $('#main_content').show();
//            $('#main_content').fadeIn(1000);
            $('#backed_panel').hide();
            $('#fundfolio_panel').hide();
            $('#help_center_panel').hide();

            var h = $('#main_content').height();

            setInterval( function() {
                var w = $('#myDiv').width();
                w = (w - 50) / 2;
//                alert(w);
                w = Math.floor(w);
                $('#card3').width(w);
                $('#card4').width(w);

                var card1 = $('#card1');
                w = card1.width();
                card1.height(w*66/100);

                var card2 = $('#card2');
                w = card2.width();
                card2.height(w*1.13);

                var card3 = $('#card3');
                w = card3.width();
                card3.height(w*0.58);

                var card4 = $('#card4');
                w = card4.width();
                card4.height(w*0.58);

                var card5 = $('#card5');
                w = card5.width();
                card5.height(w*0.5033);

//                $('#backed_panel').width(w);
                $('#backed_panel').height(h);

//                $('#fundfolio_panel').width(w);
                $('#fundfolio_panel').height(h);

//                $('#helpcenter_panel').width(w);
                $('#help_center_panel').height(h);

            }, 500);

            // media query event handler
            if (matchMedia) {
                var mq = window.matchMedia("screen and (max-width: 1360px)");
                mq.addListener(WidthChange);
                WidthChange(mq);
            }
			
			var el = document.getElementById("div_show");
				el.onclick = showSearchBox;
			
			function showSearchBox(){
				//alert("test");
				
				 //$('#loc_name').show();
				  var loc_name = document.getElementById("loc_name");
				  if( loc_name.style.visibility == "visible" )
					loc_name.style.visibility = "hidden"
				  else
					loc_name.style.visibility = "visible"
			}

            // media query change
            function WidthChange(mq) {
                if (mq.matches) {
                    $('#site').hide();
                    $('#site-menu').show();
                    $('#big-sexy').show();
                } else {
                    $('#site').show();
                    $('#big-sexy').hide();
                    $('#site-menu').hide();
                }
            }

            $('#card5').click(function () {
                h = $('#main_content').height();
                $('#main_content').hide();
                $('#backed_panel').hide();
                $('#fundfolio_panel').hide();
//                $('#help_center_panel').show();
                $('#help_center_panel').fadeIn(1000);
                window.scrollTo(0, 0);
            });

            $('#card4').click(function () {
                h = $('#main_content').height();
                $('#main_content').hide();
                $('#backed_panel').hide();
             //   $('#fundfolio_panel').show();
                $('#fundfolio_panel').fadeIn(1000);
                $('#help_center_panel').hide();
                window.scrollTo(0, 0);
            });

            $('#card3').click(function () {
                h = $('#main_content').height();
                $('#main_content').hide();
//                $('#backed_panel').show();
                $('#backed_panel').fadeIn(1000);
                $('#fundfolio_panel').hide();
                $('#help_center_panel').hide();
                window.scrollTo(0, 0);
            });

            $('.close').click( function () {
//                $('#main_content').show();
                $('#main_content').fadeIn(1000);
                $('#backed_panel').hide();
                $('#fundfolio_panel').hide();
                $('#help_center_panel').hide();
            });
            
            $('#view_history').click( function () {
                $("#view_history_popup").dialog({
                    width:'60%',
                    height:'auto',
                    dialogClass: 'success-dialog',
                    position:{my:"center top+200",at:"center top+200", of:"body"},
                    buttons: {
                    }
                });
            });
            
            $('#set_auto_back').click( function () {
                $("#set_auto_back_popup").dialog({
                    width:'60%',
                    height:'auto',
                    dialogClass: 'success-dialog',
                    position:{my:"center top+200",at:"center top+200", of:"body"},
                    buttons: {
                    }
        });
            });
        
            $('#exchange_community_points').click( function () {
                $("#exchange_community_points_popup").dialog({
                    width:'60%',
                    height:'auto',
                    dialogClass: 'success-dialog',
                    position:{my:"center top+200",at:"center top+200", of:"body"},
                    buttons: {
                    }
                });
            });
            
            $(window).load(function (){
            // Load the Visualization API and the corechart package.
            google.charts.load('current', {'packages':['corechart']});

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                // Create our data table out of JSON data loaded from server.
                var data = new google.visualization.DataTable(<?php echo $profilepage_info['jsonTable']; ?>);
                var options = {
                    title: 'Interested Fund Categorized',
                    is3D: true,
                    'width': $(window).width()/2,
                    'height': 500,
                    chartArea: {left: 50, top: 50, width: "100%", height: "100%"},
                    backgroundColor: { fill:'transparent' },
                    //sliceVisibilityThreshold:0
                  };
                // Instantiate and draw our chart, passing in some options.
                // Do not forget to check your div ID
                var chart = new google.visualization.PieChart($('#chart_div')[0]);
                chart.draw(data, options);
            } 
        });
        });
        function togglenav() {
//            alert('here');
            var toggle = $('#site-menu');
            var toggle_btn = $('#big-sexy');
            toggle.toggleClass('open');
        }
    </script>


        
</body>
</html>
