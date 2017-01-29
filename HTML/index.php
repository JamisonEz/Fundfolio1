
<?php 

include("../functions.php");	
$db = new DBController();

/* $campaignname ,  $description ,  $campaignimage ,  $amount ,  $days ,  $total_backers ,  $isfunded ,  $categoryid ,  $latitude ,  $longitude ,  $loginid */

/* $_POST['company_team_name'],
$_POST['company_tag_line'],
$_POST['descriptionfolio'],
$_POST['fileimage'],
$_POST['filevidio'],


$_POST['company_goal'],
$_POST['cat_id'],

$_POST['company_location'],
$_POST['quote_input'],
$_POST['link'] */


		if(! $db -> CheckLogin()){
                         header("Location: /index.php");
							die();
			
		}
		
		

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	//echo "post work";
		//if( isset( $_POST['add_form']))
			
			$image_name = "" ;

			if( !empty( $_FILES["fileimage"]["name"] )){

			
				//$image_name = $_FILES["fileimage"]["name"];
				
				$temp = explode(".", $_FILES["fileimage"]["name"]);
				
				$image_name = 'img_'.round(microtime(true)) . '.' . end($temp);
				
				
				$target_dir = "../campaign_uploads/";
				
				$target_file = $target_dir . basename($image_name);
				//$target_file = $target_dir . basename($_FILES["fileimage"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
				//if(isset($_POST["submit"])) {
					$check = getimagesize($_FILES["fileimage"]["tmp_name"]);
					if($check !== false) {
						//echo "File is an image - " . $check["mime"] . ".";
										
						$uploadOk = 1;
						
					} else {
						
						$image_name ="";
						//echo "File is not an image.";
						$uploadOk = 0;
					}
					
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
						//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						$uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						//echo "Sorry, your file was not uploaded.";
					// if everything is ok, try to upload file
					} else {
						if (move_uploaded_file($_FILES["fileimage"]["tmp_name"], $target_file)) {
							//echo "The file ". basename( $_FILES["upload_img"]["name"]). " has been uploaded.";
						} else {
							$image_name ="";
							echo "Sorry, there was an error uploading your file.";
						}
					}
				//}
			}
			
			$vidio_name = "" ;
			
			if( !empty( $_FILES["filevidio"]["name"] )){

			
				//$vidio_name = $_FILES["filevidio"]["name"];
				
				$temp = explode(".", $_FILES["filevidio"]["name"]);
				
				$vidio_name = 'vid_'.round(microtime(true)) . '.' . end($temp);
				
				
				$target_dir = "../campaign_uploads/";
								
				$target_file = $target_dir . basename($vidio_name);
				
				$uploadOk = 1;
				$allowedExts = array( "mp3", "mp4", "wma");
				//$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
				//if(isset($_POST["submit"])) {
					//$check = getvideosize($_FILES["filevidio"]["tmp_name"]);
					
					
					// Allow certain file formats
					if($imageFileType != "mp3" && $imageFileType != "mp4" && $imageFileType != "wma") {
						//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						$uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						//echo "Sorry, your file was not uploaded.";
					// if everything is ok, try to upload file
					} else {
						
						//echo "    upload in pro ";
						if( move_uploaded_file($_FILES["filevidio"]["tmp_name"], $target_file)) {
							//echo "The file ". basename( $_FILES["upload_img"]["name"]). " has been uploaded.";
						} else {
							$vidio_name ="";
							echo "Sorry, there was an error uploading your Video.";
						}
					}
				//}
			}
			
			
			
			
					$res = $db -> addCampaign ( 
					
							$_POST['company_team_name1'],
							$_POST['company_tag_line1'],
							$_POST['descriptionfolio'],
							$image_name,
							$vidio_name,


							$_POST['company_goal'],
							$_POST['no_of_days'],
							100,
							0,
							$_POST['cat_id'],
							
							$_POST['company_location'],
							$_POST['quote_input'],
							$_POST['link'],
							$db ->UserUserID()
							 );
					if( $res > 0){
						header("Location: ".$_SERVER['HOST_NAME']."/Fundfolio1-master/homescreen.php?cat_id=".$_POST['cat_id'], true);
							die();
						
					}
						
						//echo "Sucsess";

		}
		
		
		
		

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Fundfolio</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
	
	<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>


    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/creative.min.css" rel="stylesheet"> 
	
	<style>
	.sahil{
		cursor:pointer;
	}
	</style>
</head>

<body id="page-top"> 
    <header>
	<div id="overlay">
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">Let's Change the World.</h1>
                <hr style="border-color: transparent;">
                <p>Welcome to the beginning of your crowdfunding journey!  Fundfolio is the world’s SMARTest way crowdfund. Have fun using our Folio CubeTM  to engage family, friends, neighbors and even strangers, in your “campaign that matters.” We are so excited you are here!</p>
              <a class="downarrow page-scroll" href="#portfolio"  >Let's Start!</br><img src="img/downarrow.png" style="max-width:75px"></a>
            </div>
        </div>
		</div>
    </header> 
	
	
    <section class="no-padding" id="portfolio"  style="margin-top: 20px;background:#eee;">
        <div class="container-fluid">
            <div class="row no-gutter popup-gallery  ">
			<div class="col-lg-12">
			<div class="col-lg-1"></div>
                <div class="col-lg-4 col-sm-6">
                    <a  class="portfolio-box sahil">
                        <img id = "category_img" src="img/pwork1.png" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                
                            </div>
                        </div>
                    </a>
                </div>
				 <div class="col-lg-6" style="padding: 0px;">
                <div class="col-lg-4 col-sm-6">
                    <a  onclick="selectCatogory('img/pwork2.png' ,  1 )"  class="portfolio-box sahil">
                        <img src="img/pwork2.png" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                   Business
                                </div>
                            </div>
                        </div>
						<div id="ctname">Business</div>
                    </a>
                </div>
                <div class="col-lg-8 col-sm-6">
                    <a onclick="selectCatogory('img/pwork3.png' , 2 )" class="portfolio-box sahil">
                        <img src="img/pwork3.png" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                   Travel
                                </div>
                            </div>
                        </div>
					<div id="ctname">Travel</div>
                    </a>
                </div>
				  <div class="col-lg-4 col-sm-6">
                    <a onclick="selectCatogory('img/pwork4.png' , 3 )" class="portfolio-box sahil">
                        <img src="img/pwork4.png" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                   Sports
                                </div>
                            </div>
                        </div>
						<div id="ctname">Sports</div>
                    </a>
                </div>
				<div class="col-lg-4 col-sm-6">
                    <a onclick="selectCatogory('img/pwork5.png' , 4)" class="portfolio-box sahil">
                        <img src="img/pwork5.png" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                   Health
                                </div>
                            </div>
                        </div>
						<div id="ctname">Health</div>
                    </a>
                </div>
				<div class="col-lg-4 col-sm-6">
                    <a onclick="selectCatogory('img/pwork6.png' , 5 )" class="portfolio-box sahil">
                        <img src="img/pwork6.png" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                   Philanthropy
                                </div>
                            </div>
                        </div>
						<div id="ctname">Philanthropy</div>
                    </a>
                </div>
                </div>
				<div class="col-lg-1"></div></div>
				<div class="col-lg-12"><div class="col-lg-1"></div>
				 <div class="col-lg-4 col-sm-6 prtbottomlyr"  >
                    <a onclick="selectCatogory('img/pwork7.png' , 6 )" class="portfolio-box sahil">
                        <img src="img/pwork7.png" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                   Arts
                                </div>
                            </div>
                        </div>
						<div id="ctname">Arts</div>
                    </a>
                </div>
				<div class="col-lg-6" style="padding:0;" id="prtbottomlyr" > 
				 <div class="col-lg-4 col-sm-6">
                    <a onclick="selectCatogory('img/pwork8.png' , 7 )" class="portfolio-box sahil">
                        <img src="img/pwork8.png" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Journalism
                                </div>
                            </div>
                        </div>
						<div id="ctname">Journalism</div>
                    </a>
                </div>
				 <div class="col-lg-4 col-sm-6">
                    <a onclick="selectCatogory('img/pwork9.png', 8)" class="portfolio-box sahil" >
                        <img src="img/pwork9.png" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                   Pets & Animals
                                </div>
                            </div>
                        </div>
					<div id="ctname">Pets & Animals</div>
                    </a>
                </div>
				 <div class="col-lg-4 col-sm-6">
                    <a onclick="selectCatogory('img/pwork10.png' , 9 )" class="portfolio-box sahil">
                        <img src="img/pwork10.png" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                 Education
                                </div>
                            </div>
                        </div>
						<div id="ctname">Education</div>
                    </a>
                </div> 
				</div>
				<div class="col-lg-1"></div>
				</div>
				
               
				
                </div>
            </div>
         
    </section>
	
	
		
		 <section class="no-padding" id="fillform"  style="margin-top: 20px;">
			<div class="container-fluid no-padding"> 
					<div class="col-lg-6 col-sm-6 no-padding" id="dataform">
					
					<div id="form_step_1" style="display:block;">
					<h2>Name Of Your Folio</h2>
					<p><strong>Work at a large company?</strong> You might want to name your slack after your division, or working group.</p>
					<p style="margin: 10px 0px;"><strong>Company or team name</strong> (You can Change this later)</p>
					<input type="text" onkeyup="companyheader();" class="getdatainput" id="company_team_name" name="company_team_name" value="" placeholder="Ex. Acme or Acms Marketing"/>
					<p style="margin: 25px 0 10px;"><strong>Tag Line</strong></p>
					<input type="text" onkeyup="companytag();" class="getdatainput" id="company_tag_line" name="company_tag_line" value="" placeholder="Working together to end homelessness"/>
					<div class="sub_but_class"><button style="color:grey;" class="btn next_step" onclick="showseconddiv();" id="next_form" >Next<i class="fa fa-arrow-right" aria-hidden="true" style="padding: 0px 0px 0px 10px;"></i></button> </div>
					</div>

					
					
					
						<div id="form_step_2" style="display:none;">
						<h2>Add Detail</h2>
						  <ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#sectionA"><i class="fa fa-usd" aria-hidden="true" style="color: #37bc8f;"></i><br>Goal</a></li>
			<li><a data-toggle="tab" href="#sectionB"><i class="fa fa-map-marker" aria-hidden="true" style="color: #64a7d2;"></i><br>Location</a></li>
			<li><a data-toggle="tab" href="#sectionC"><i style="line-height: 1; color: #333; font-family: arial;">Aa</i><br>Text</a></li>
			<li><a data-toggle="tab" href="#sectionD"><i class="fa fa-camera" aria-hidden="true" style="color: #c6384e;"></i><br>Photo</a></li>
			<li><a data-toggle="tab" href="#sectionE"><i class="fa fa-youtube-play" aria-hidden="true" style="color: #4578cb;"></i><br>Video</a></li>
			<li><a data-toggle="tab" href="#sectionF"><i class="fa fa-quote-left " aria-hidden="true" style="color: #f4a445;"></i><br>Quote</a></li>
			<li><a data-toggle="tab" href="#sectionG"><i class="fa fa-link " aria-hidden="true" style="color: #a9a9a9;"></i><br>Link</a></li>
			<!--<li><a data-toggle="tab" href="#sectionH"><i class="fa fa-share-alt " aria-hidden="true" style="color: #8febe8;"></i><br>Share</a></li>-->
			
		</ul>
		
		<form  method="post" name = "add_form" id = "add_form" action = "" enctype="multipart/form-data" >
		
		<input type = "hidden" name = "company_team_name1" id = "company_team_name1" />
		<input type = "hidden" name = "company_tag_line1"  id = "company_tag_line1" />
		<input type = "hidden" name = "cat_id" id = "cat_id" />
		
		<div class="tab-content">
			<div id="sectionA" class="tab-pane fade in active">
				<div style="margin-top:40px;"> <input type="text" onkeyup="companygoal();" class="getdatainput" id="company_goal"     name="company_goal"  value="" placeholder="Ex. $600 USD"/>
				
				  <!--onchange="printValue('no_of_days','no_of_days_label')"-->
				</div>
				
				<div style="margin-top:40px;"> 
				<input id="no_of_days" name="no_of_days" type="range"  value = "1" min="1" max="30" step="1"    />
				 <label id="no_of_days_label">1</label>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  				 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  				 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 				 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  				 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;				 
				 <label id="total_no_of_days_label">30 <strong>Days</strong></label>
				 </div>
				 
				 
				
				
			</div>
			<div id="sectionB" class="tab-pane fade">
				<div style="margin-top:40px;"> <input type="text" onkeyup="companylocation();" class="getdatainput" id="company_location"  name="company_location" value=""  placeholder="Ex. Together Hands Indianapolis, United States"/>
				</div>
			</div>
			 <div id="sectionC" class="tab-pane fade">
				<div style="margin-top:40px;">  <textarea rows="4" cols="50" onkeyup="companytext();" id="descriptionfolio"  name="descriptionfolio"  placeholder="Describe your Folio"></textarea> 
				</div>
			</div>
			 <div id="sectionD" class="tab-pane fade">
				<div style="margin-top:40px;"> 
				<input type="file" onchange="readImgURL(this);" id="fileimage" name="fileimage" value="" />
				</div>
			</div>
			 <div id="sectionE" class="tab-pane fade">
				<div style="margin-top:40px;"> <input type="file"  onchange="readVidioURL(this);" id="filevidio" name="filevidio" value=""  />
				</div>
			</div>
			 <div id="sectionF" class="tab-pane fade">
				<div style="margin-top:40px;"> <textarea rows="4"  cols="50" onkeyup="companyquote();" id="quote_input" name="quote_input" placeholder="Quote Here"></textarea> 
				</div>
			</div>
			 <div id="sectionG" class="tab-pane fade">
				<div style="margin-top:40px;"> <input type="text" onkeyup="" class="getdatainput" id="link" name="link" value="" placeholder="Ex. Any custom Link here"/>
				</div>
			</div>
			 <div id="sectionH" class="tab-pane fade">
				<div style="margin-top:40px;">  
				</div>
			</div>
			
			<div class="sub_but_class"><button style="color:grey;" class="btn next_step" onclick="return showseconddiv1();" id="submit_form" >Submit<i class="fa fa-arrow-right" aria-hidden="true" style="padding: 0px 0px 0px 10px;"></i></button> </div>
			
			</div>
			</form>
			
			</div> 	
					</div>
			   <div class="col-lg-6 col-sm-6 no-padding" id="Previewfrom">
					<div class="col-lg-12 main_preview_start"  >
				<div   style=" min-height: 550px;background:#4a448A;border-radius: 0 0 0 15px;float:left;width:7%;"></div>
				<!-- preivew from start here -->
				<div id="mainpreviewcontainer" style="min-height: 550px; border-bottom: 30px solid #d8d8d8;background:#fff;float:left;width:86%;">  
				
				<div class="prevideo"   >
				<div id="port_video_container">
                                    <video id="port_video" controls></video><!--<embed id = "port_video" style="height:203px;width:100%;" src="">--></div> <!--http://www.youtube.com/v/XGSy3_Czz8k -->
				<!--<iframe width="420" height="345" src="https://www.youtube.com/embed/XGSy3_Czz8k">
</iframe>-->
				<div id="prelocation"> 
				<div class="llctionpre"><p id="locationtextpre"></p> 
				</div></div>
				</div>
				  <div class="prerightfst">
				  <div class="preheaderfst">
				<h4 id="pretittle"></h2>
				<p id="pretagline"></p> </div>
				<div class="preheadimage"  >  <img id = "img_cat" class="preheadimage" src="" /> </div>
				<div class="belwimagepre"><p id="belowimagetextpre"></p> </div>
				</div> 
				
			  <div id="preleftsecound">
			  <div id="imagehere"> <img id = "camp_img"  src="" /> </div>
			  <div id="texthere"><p> </p> </div> 
			  <div id="textbighere"><p> </p> </div> 
			  
			  </div>			
			  <div id="prerightsecound"></div>			
				
				</div>
				<!-- preivew form end here -->
				<div  style=" min-height: 550px;background:#4a448A;border-radius: 0 0 15px 0;float:right;width:7%;"></div>
					 
					</div>
					</div>
			 </div>
		</section> 
	
 
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 ">
                      <ul class="nav navbar-nav" id="bottomnav">
      <li><a href="#">About</a></li>
      <li><a href="#">Jobs</a></li>
      <li><a href="#">Press</a></li>
      <li><a href="#">Help Center</a></li>
      <li><a href="#">Get Started</a></li>
      <li><a href="#">Handbook</a></li>
    </ul>
	
	 <ul class="nav navbar-nav" id="bottomnavbelow">
      <li><a href="javascript:;"> © 2016 Fundfolio Crowdfunding Company</a></li>
      <li><a href="#">Privacy</a></li>
      <li><a href="#">Terms</a></li>
      <li><a href="#">Safety and Use</a></li>
     
    </ul>
                </div>
				
				  <div class="col-lg-6 ">
				  <div class="conntected_form">
                      <input placeholder="Email Address" style="background-color: white; padding-left: 15px; border: 0;height: 40px; width: 300px; " type="text">
					  <button style="background-color: #4276E2; width: 150px; height: 40px; color: white; font-size: large; border-radius: 0 5px 5px 0; padding: 0; border: 0; margin-left: -4px">Stay Connected</button>
                </div>
				 <ul class="nav navbar-nav" id="bottomnavrightsde">
      <li><a href="#"><i class="fa fa-hand-peace-o" aria-hidden="true"></i></a></li>
      <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
      <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
      <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
      <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
     
    </ul>
	 <select id="changelanguage" class="changelanguage">
  <option value="English">English</option>
  <option value="Spanish">Spanish</option>
  <option value="German">German</option> 
</select> 
				
				
                </div>
              
            </div>
        </div>
    </footer>
	
	 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	
 <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyCgwupCCqrpms0vsY6k4ijoVEeGgNZQnZs&language=en-AU"></script>
        <script>
            var autocomplete = new google.maps.places.Autocomplete($("#company_location")[0], {});

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
				
				//alert ("val "+$('#company_location').val());
				
				document.getElementById("locationtextpre").innerHTML = $('#company_location').val();
                console.log(place.address_components);
            });
        </script>
	
	   
<script>


$(function () {

    // on page load, set the text of the label based the value of the range
    //$('#no_of_days_label').text(rangeValues[$('#rangeInput').val()]);

    // setup an event handler to set the text when the range value is dragged (see event for input) or changed (see event for change)
    $('#no_of_days').on('input change', function () {
        $('#no_of_days_label').text( $(this).val() );
		
		var cmdetail=document.getElementById("company_goal").value;
		 
		if( cmdetail != "" )
			 cmdetail += " USD for "+ $(this).val() +" days";
		 else 
			  cmdetail += "0 USD for "+ $(this).val() +" days";
   
		document.getElementById("belowimagetextpre").innerHTML=cmdetail; 
		
		
    });

});


function readVidioURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#port_video')
                        .attr('src', e.target.result)
                        ;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


 function readImgURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#camp_img')
                        .attr('src', e.target.result)
						.width(120)
                        .height(120)
                        ;
                };
				/* .width(150)
                        .height(200) */

                reader.readAsDataURL(input.files[0]);
            }
        }


 function printValue(sliderID, textbox) {
	 
	
	
        var x = document.getElementById(textbox);
        var y = document.getElementById(sliderID);
		
		
		
		 //alert(""+ y.value);
        x.innerHTML = y.value;
		
		
		 var cmdetail=document.getElementById("company_goal").value;
		 
		if( cmdetail != "" )
			 cmdetail += " USD for "+ y.value+" days";
		 else 
			  cmdetail += "0 USD for "+ y.value+" days";
   
		document.getElementById("belowimagetextpre").innerHTML=cmdetail; 
		
		
 
		
		
    }

/* function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#camp_img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
} */




function showseconddiv()
{
    var cmname=document.getElementById("company_team_name").value;
    var cmtg=document.getElementById("company_tag_line").value;
	
	var cat_id =document.getElementById("cat_id").value;
	
	var checker=0;
	
	if(cat_id.length>0){ checker=1; }else{ checker=2; }
	
	if(checker==2) {
    alert('Please Select Category First');
	return false;
	}
	
	if(cmname.length>0){ checker=1; }else{ checker=0; }
	if(cmtg.length>1){ if(checker==1){ checker=1; } }else{ checker=0; }
	
	if(checker==1){
    document.getElementById("form_step_1").style.display='none';
    document.getElementById("form_step_2").style.display='block';
	
	document.getElementById("company_team_name1").value = cmname;
	document.getElementById("company_tag_line1").value = cmtg;
	
    }
	
	
	else if(checker==0) {
		alert('Please Fill the Above Fields First');
                return false;
	}
	
}

function showseconddiv1()
{
	
	
    var cmname=document.getElementById("company_team_name").value;
    var cmtg=document.getElementById("company_tag_line").value;

	
	 var goal_amount = document.getElementById("company_goal").value;
	 var location = document.getElementById("company_location").value;
	 var description = document.getElementById("descriptionfolio").value;

	 var quote = document.getElementById("quote_input").value;
		  
	 var fileimage = document.getElementById("fileimage").value;
	
	 var filevidio = document.getElementById("filevidio").value;
	  
	 
	  if(!(goal_amount .length > 0)){
		   alert('Please Enter Folio Goal Amount');
		   return false;
	  }
	  else if(!(location .length> 0)){
		   alert('Please enter Folio Location');
		   return false;
	  }
	
	  else if(  !(description .length> 0) && !(quote .length> 0)){
		   alert('Please enter Folio description or quote text');
		   return false;
	  }
	  else if(!(fileimage .length>0) && !(filevidio.length>0)){
		  alert('Please Select a Image or Video');
		  return false;
	  }
	  else{
			var checker=0;
			if(cmname.length>1){ checker=1; }else{ checker=0; }
			if(cmtg.length>1){ if(checker==1){ checker=1; } }else{ checker=0; }
			if(checker==1){
				
				document.getElementById("form_step_1").style.display='none';
				document.getElementById("form_step_2").style.display='block';
				
				document.getElementById("company_team_name1").value = cmname;
				document.getElementById("company_tag_line1").value = cmtg;
				
				return true;
				//document.getElementById('add_form').submit();
			
			
			}else{
			return false;
			}
	  }


}



function selectCatogory( img , cat_id )
{
	
	document.getElementById("cat_id").value =cat_id;
	//alert ("dd"+img);
   /* var cmname=document.getElementById("company_team_name").value;
   document.getElementById("pretittle").innerHTML=cmname; */
   
  // document.getElementById("img_cat").src=img;
   document.getElementById("category_img").src=img;
  
}

function companyheader()
{
   var cmname=document.getElementById("company_team_name").value;
   document.getElementById("pretittle").innerHTML=cmname;
  
}
function companytag()
{
 var cmname=document.getElementById("company_team_name").value;
    
   var cmtag=document.getElementById("company_tag_line").value;
   document.getElementById("pretagline").innerHTML=cmtag; 
   
}
function companygoal()
{
  var cmvalidate=document.getElementById("company_tag_line").value;
   
   var cmdetail=document.getElementById("company_goal").value;
   
	var sliderVal =document.getElementById("no_of_days").value;
		 if( cmdetail != "" )
			 cmdetail += " USD for "+ sliderVal+" days";
		 else 
			  cmdetail += "0 USD for "+ sliderVal+" days";
		 
	
   
   document.getElementById("belowimagetextpre").innerHTML=cmdetail; 
   
}
function companylocation()
{
  var cmvalidate=document.getElementById("company_goal").value; 
   var cmdetail=document.getElementById("company_location").value;
   document.getElementById("locationtextpre").innerHTML=cmdetail;  
}
function companytext()
{ 
   var cmdetail=document.getElementById("descriptionfolio").value;
   document.getElementById("textbighere").innerHTML='<p>'+cmdetail+'</p>';  
}
function companyimage()
{ 
   var cmdetail=document.getElementById("fileimage").value;  
   //document.getElementById("textbighere").innerHTML='<p>'+cmdetail+'</p>';  
}
function companyquote()
{ 
   var cmdetail=document.getElementById("quote_input").value;  
    document.getElementById("texthere").innerHTML='<p>'+cmdetail+'</p>';  
}

/* $("#fileimage").change(function(){
    readURL(this);
}); */
	
</script>
    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
       <!--<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script> -->

    <!-- Theme JavaScript -->
    <script src="js/creative.min.js"></script>

</body>

</html>
