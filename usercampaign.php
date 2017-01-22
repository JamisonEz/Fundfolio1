<!DOCTYPE html>
<html lang="en">
<head>
    <title>Usercampaign</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Latest compiled and minified CSS -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <link type="text/css" rel="stylesheet" href="usercampaign.css">
    
    <script type="text/javascript" src="jquery-ui-1.12.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="jquery-ui-1.12.0/jquery-ui.min.css">
    
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
        Stripe.setPublishableKey('pk_test_ALLXQ4toDK0RVyF6c3hTtSha');
    </script>
    <script src="https://checkout.stripe.com/checkout.js"></script>

</head>
<?php 
    require_once('functions.php');
    $db = new DBController();
    
    $folio_id = 1;
    $matrix_info = ($db->getMatrixforthefolio($folio_id));
    $user_info = ($db->getAllUserInfo());
    $donation_info = ($db->getDonationlist($folio_id));
    $folio_info = ($db->getCampaignById($folio_id));
    //echo "<pre>";
    //var_dump($getMatrix);
    //var_dump($db->getAllUserInfo());
    //exit;
?>
<body>
    <header>
        <!--<div class="container-fluid">-->
            <!--<div class="row vertical-align">-->
                <!--<div class="col-xs-3 logo wrap-auto">-->
                    <!--<img src="images/logo1.png" class="wrap-full">-->
                <!--</div>-->
                <!--<div class="col-xs-4 text-center">-->
                    <!--<div class="row vertical-align">-->
                        <!--<div class="col-xs-4 wrap-auto">-->
                            <!--<h4><b>Explore</b></h4>-->
                        <!--</div>-->
                        <!--<div class="col-xs-4 wrap-auto">-->
                            <!--<h4><b>Start a project</b></h4>-->
                        <!--</div>-->
                        <!--<div class="col-xs-4 wrap-auto">-->
                            <!--<h4><b>About us</b></h4>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="col-xs-3 col-xs-offset-1 wrap-auto-sm">-->
                    <!--<div class="row">-->
                        <!--<div class="user-img wrap-auto col-xs-3">-->
                            <!--<img class="img-circle" src="images/background.png" alt="Profile Pic" width="50px">-->
                        <!--</div>-->
                        <!--<div class="user-name wrap-auto col-xs-8 col-xs-offset-1 text-center text-uppercase">-->
                            <!--<p>Welcome, <b>taylor</b></p>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand wrap-auto" href="#"><img src="images/logo1.png" class="logo"></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav middle">
                        <li><a href="#">Explore</a></li>
                        <li><a href="#">Start a project</a></li>
                        <li><a href="#">About us</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">
                            <div class="user-img wrap-auto">
                                <img class="img-circle" src="images/background.png" alt="Profile Pic" width="50px">
                            </div>
                        </a></li>
                        <li><a href="#">
                            <div class="user-name text-center text-uppercase">
                                <p>Welcome, <b>taylor</b></p>
                            </div>
                        </a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div id="donate_to_folio" style='display:none'>
        You can choose either of below options to pay the amount.
    </div>
    <form id="stripeForm" action="" method="POST" style="display:none;">
        <input type="text" id="stripeAmount" name="stripeAmount"/>
        <input type="hidden" id="stripeToken" name="stripeToken"/>
        <input type="hidden" id="stripeEmail" name="stripeEmail"/>
    </form>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-7 wrap-full-sm">
                <iframe width="100%" src="https://www.youtube.com/embed/ydRAb9cwHnA" frameborder="0" allowfullscreen></iframe>
                <div class="row">
                    <div class="col-xs-1 wrap-auto">
                        <img src="images/location-blue.png" width="20" height="30">
                    </div>
                    <div class="col-xs-1 wrap-auto no-l-padding text-center">
                        <p style="margin: 5px 5px; font-size: large"><b>Together Hands</b> Indianapolis, United States</p>
                    </div>
                    <div style="float: right;">
                        <div class="col-xs-1 wrap-auto no-l-padding">
                            <a href="#"><img src="images/heart-holo.png" width="50" height="50"></a>
                        </div>
                        <div class="col-xs-1 wrap-auto no-l-padding">
                            <a href="#"><img src="images/facebook-holo.png" width="50" height="50"></a>
                        </div>
                        <div class="col-xs-1 wrap-auto no-l-padding">
                            <a href="#"><img src="images/twitter-holo.png" width="50" height="50"></a>
                        </div>
                        <div class="col-xs-1 wrap-auto no-l-padding">
                            <a href="#"><img src="images/link-holo.png" width="50" height="50"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-4 common-margin font-bolder wrap-auto">
                <div id="table-div">
                    <h1>Together Hands</h1>
                    <h4>Working together to end homelessness</h4>
                    <table>
                        <tbody>
                        <?php
                            $dimension = count($matrix_info);
                            foreach($matrix_info as $chunk_id => $chunk_val)
                            {
                                ?>
                                <tr>
                                    <?php
                                        if(count($chunk_val) < $dimension)
                                        {
                                            $fill_up = $dimension - count($chunk_val);
                                            foreach(range(1, $fill_up) as $fill_r)
                                            {
                                                $chunk_val['-'.$fill_r] = '';
                                            }
                                        }
                                        foreach($chunk_val as $amount => $donator_id)
                                        {
                                            $donated_flag = $donator_id!="" && strpos($donator_id, '_')===false ? true : false;
                                            ?>
                                            <td style="<?php echo $donated_flag ? 'background-color:#e4a24c; color:white' : 'cursor:pointer;';?>" class="<?php echo !$donated_flag ? 'donate_to_folio' : '' ;?>" rel='<?php echo $amount;?>'>
                                                <?php
                                                    if($amount>0)
                                                    {
                                                        echo $amount;
                                                    }
                                                    else 
                                                    {
                                                        echo "";
                                                    }
                                                ?>
                                            </td>
                                            <?php
                                        }
                                    ?>
                                </tr>
                                <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $donation_info['progressbarinfo']['percentage_completed']; ?>"
                         aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $donation_info['progressbarinfo']['percentage_completed']; ?>%"></div>
                </div>
                <span style="font-size: xx-large"><b>$<?php echo $donation_info['progressbarinfo']['total_donations']; ?> </b></span><span style="font-size: x-large">USD raised by <b><?php echo $donation_info['progressbarinfo']['total_donators']; ?></b> of <b><?php echo $donation_info['progressbarinfo']['needed_backers']; ?></b> Backers</span>
            </div>
        </div>
    </div>

    <div class="container-fluid ">
        <div class="row">
            <div class="col-xs-7 wrap-full-sm middle-content-1">
                <p>OVERVIEW</p>
                <div class="row margin-b">
                    <div class="col-xs-6">
                        <img src="images/image-1.png" width="100%">
                    </div>
                    <div class="col-xs-6 overview-detail">
                        <p><b>Together Hands.</b> It might seem unnecessary to ask why it is important to deal with the
                            crisis of homelessness. It takes the commitment of many to solve this issue, not just the
                            government. All of us!<br><br> The most important reason to solve the crisis is that it is the
                            right thing to do. People deserve a place to live and we have the resources to make that
                            possible. We are caring and decent people, that have the means, and believe that everyone
                            is entitled to a home.
                        </p>
                    </div>
                </div>
                <nav class="navbar navbar-inverse">
                    <ul class="nav navbar-nav">
                        <li><a href="#">STORY</a></li>
                        <li><a href="#">UPDATES(6)</a></li>
                        <li><a href="#">COMMENTS</a></li>
                    </ul>
                </nav>
                <h1><b>Short Summary</b></h1>
                <div>
                    <p style="color: rgb(67,67,67); font-size: large; text-align: justify">
                        HT continues to help the areas affected by Hurricane Matthew. Even though the news stories of the hurricane have become quiet, the damage is very real and there is a long way to go in rebuilding. We continue to repair our headquarters in Port-au-Prince where our schools suffered flooding damage and the latrines at the high school were completely destroyed. We continue to provide critical care to the hardest hit areas of Jeremie and Les Cayes where roofs were ripped off buildings and people are in desperate need of shelter, food, and water.

                        Fr. Tom, Doug and HT staff are working with the Missionary Sisters of Charity and local parishes to provide food, water, and building supplies to help those displaced by the storm.  Fr. Tom & Doug continue to make regular trips to Jeremie and Les Cayes to bring building supplies and food.

                        HT will continue to bring aid to those in the rural villages that will likely escape the eye of the larger relief                             agencies. We are grateful for any help you can give so that we can assist those who have lost everything!
                    </p>
                </div>
            </div>
            <div class="col-xs-4 common-margin wrap-full-sm middle-content-2">
                <p>DONATIONS</p>
                <div class="donate">
                    <?php 
                        $donation_list = $donation_info['list'];
                        foreach($donation_list as $donar_details)
                        {
                            ?>
                            <div class="row no-l-margin margin-b">
                                <div class="media">
                                    <div class="media-left">
                                        <!--<img src="images/campaign1.png" class="media-object" style="width:60px">-->
                                        <div class="donation-amount-img">
                                            <p><?php echo $donar_details['amount'];?></p>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading"><?php echo $donar_details['name'];?></h4>
                                        <p><?php echo $donar_details['elapsed_time_string']; ?></p>
                                    </div>
                                    <div class="media-right">
                                        <div class="row wrap-auto" style="width: 130px; margin: 0">
                                            <a href="">
                                                <div class="col-xs-6 no-l-padding wrap-auto">
                                                    <img src="images/heart-new.png" class="media-object" style="width:30px">
                                                </div>
                                            </a>
                                            <a href="">
                                                <div class="col-xs-6 no-l-padding wrap-auto">
                                                    <img src="images/share.png" class="media-object" style="width:30px">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!--Footer-->
    <footer class="container-fluid" style="background-color: #F9F9F9">
        <div class="container">
            <div id="footer_links" class="row">
                <div class="col-xs-1 wrap-auto">
                    <a href="#">About</a>
                </div>
                <div class="col-xs-1 wrap-auto">
                    <a>Jobs</a>
                </div>
                <div class="col-xs-1 wrap-auto">
                    <a>Press</a>
                </div>
                <div class="col-xs-1 wrap-auto">
                    <a>Help Center</a>
                </div>
                <div class="col-xs-1 wrap-auto">
                    <a>Get Started</a>
                </div>
                <div class="col-xs-1 wrap-auto">
                    <a>Handbook</a>
                </div>
                <div class="col-xs-4 wrap-auto" style="float: right">
                    <div class="input-group">
                        <input class="form-control" size="50" placeholder="Email Address" required="" type="email">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="button">Subscribe</button>
                        </div>
                    </div>
                    <!--<input type="text" placeholder="Email Address" style="background-color: white; padding-left: 15px; border: 0;height: 40px; width: 300px; ">-->
                <!--</div>-->
                <!--<div class="col-xs-2">-->
                    <!--<button style="background-color: #4276E2; width: 150px; height: 40px; color: white; font-size: large; border-radius: 2px; padding: 0; border: 0; margin-left: 30px">Stay Connected</button>-->
                </div>
            </div>
            <div id="footer_copyright" class="row">
                <div class="col-xs-2 wrap-auto" style="color: #BABABA; padding: 0">
                    © 2016 Fundfolio Crowdfunding Company
                </div>
                <div class="col-xs-1 wrap-auto">
                    <a>Privacy</a>
                </div>
                <div class="col-xs-1 wrap-auto">
                    <a>Terms</a>
                </div>
                <div class="col-xs-2 wrap-auto">
                    <a>Safety and Use</a>
                </div>
                <div class="col-xs-6 wrap-auto" style="float: right">
                    <div class="row">
                        <div class="col-xs-2" style="width: 50px">
                            <img src="images/hand1.png" style="width: 25px; height: 29px">
                        </div>
                        <div class="col-xs-2" style="width: 50px">
                            <img src="images/twitter1.png" style="width: 27px; height: 25px">
                        </div>
                        <div class="col-xs-2" style="width: 50px">
                            <img src="images/facebook1.png" style="width: 12px; height: 25px">
                        </div>
                        <div class="col-xs-2" style="width: 50px">
                            <img src="images/instagram1.png" style="width: 25px; height: 25px">
                        </div>
                        <div class="col-xs-2" style="width: 50px">
                            <img src="images/youtube1.png" style="width: 27px; height: 25px">
                        </div>
                        <div class="col-xs-2" style="width: 70px">
                            <div class="dropup">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Language
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">German</a></li>
                                    <li><a href="#">Spanish</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <script>
        $(function () {
            setInterval(function () {
                var user_img = $(".user-img img");
                var video = $('iframe');
//                var image = $('.middle-content-1 img');
//                image.height(image.width() * 0.82);
                user_img.height(user_img.width());

                // media query event handler
                if (matchMedia) {
                    var mq = window.matchMedia("screen and (min-width: 1210px)");
                    mq.addListener(WidthChange);
                    WidthChange(mq);
                }

                // media query change
                function WidthChange(mq) {
                    if (mq.matches) {
                        video.height($('#table-div').height());
                    } else {
                        video.height($('.wrap-full-sm').width() * (9/16));
                    }
                }
            }, 500);
            
            //dialogue for payment
            $('.donate_to_folio').click(function () {
                var amount = $(this).attr('rel');
                console.log(amount);
                $("#donate_to_folio").dialog({
                    modal: false,
                    width:'60%',
                    height:'auto',
                    dialogClass: 'success-dialog',
                    title: 'Donate $'+amount,
                    amount: amount,
                    buttons: {
                        "PayPal": function(){ $(this).dialog( "close" ); paypalpayment(amount)},
                        "Stripe": function(){ $(this).dialog( "close" ); stripepayment(amount)},
                    },
                    close: function() {
                        $(this).dialog( "close" );
                    }
                });
            });
            
            function paypalpayment()
            {
                console.log('paypal payment');
            }
            
            function stripepayment(amount)
            {
                var folio_name = "<?php echo $folio_info['campaignname']; ?>";
                var folio_description = "<?php echo $folio_info['description']; ?>";
                var folio_id = "<?php echo $folio_info['campaignid']; ?>";
                amount = amount*100;
                
                //to prevent simultaneous payments
                $.ajax({
                    type: "POST",
                    data: {amount:amount, folio_id:folio_id, folio_name:folio_name, folio_description:folio_description},
                    url:"payment_start.php",
                    success:function(response_flag)
                    {
                        if(response_flag==='1')
                        {
                            var handler = StripeCheckout.configure({
                                key: 'pk_test_hLl88jDU06gYZaT0V8or44gF',
                                image: '/fundfolio/images/logo.png',
                                token: function(token) {
                                    console.log(token);
                                    $.ajax({
                                        type: "POST",
                                        data: {token:token, amount:amount, folio_id:folio_id, folio_name:folio_name, folio_description:folio_description},
                                        url:"stripe_payment_response.php",
                                        success:function(response)
                                        {
                                            alert(response);
                                        },
                                        failure:function(response)
                                        {
                                            alert("Some error occured, try again.");
                                        }
                                    });
                                    //to save
                                    //$("#stripeAmount").val(amount);
                                    //$("#stripeToken").val(token.id);
                                    //$("#stripeEmail").val(token.email);
                                    //$("#stripeForm").submit();
                                }
                            });

                            // Open Checkout with further options
                            handler.open({
                              name: 'Fundfolio',
                              description: 'Donate ($'+amount+')',
                              amount: amount //as its in cents
                            });

                            // Close Checkout on page navigation
                            $(window).on('popstate', function() {
                              handler.close();
                            });
                        }
                        else
                        {
                            alert(response_flag)
                        }
                    },
                    failure:function(response_flag)
                    {
                        alert("Some error occured, try again.");
                    }
                });
            }
        })
    </script>
</body>
</html>