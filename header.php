<?php
session_start();
include 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Railways</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
        <link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
        <link rel="stylesheet" href="css/form.css" type="text/css" media="all">
        <script type="text/javascript" src="js/jquery-1.5.2.js" ></script>
        <!--<script type="text/javascript" src="js/jquery.js" ></script>-->
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript" src="js/cufon-replace.js"></script>
        <script type="text/javascript" src="js/Cabin_400.font.js"></script>
        <script type="text/javascript" src="js/tabs.js"></script>
        <script type="text/javascript" src="js/jquery.jqtransform.js" ></script>
        <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
        <script type="text/javascript" src="js/atooltip.jquery.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <!--[if lt IE 9]>
        <script type="text/javascript" src="js/html5.js"></script>
        <style type="text/css">.main, .tabs ul.nav a, .content, .button1, .box1, .top { behavior:url("../js/PIE.htc")}</style>
        <![endif]-->
    </head>
    <body id="page1">
        <div class="main">
            <!--header -->
            <header>
                <div class="wrapper">
                    <!-- <h1><a href="index.html" id="logo">Railways</a></h1> -->
                    <span id="slogan">Fast, Frequent &amp; Safe Railways</span>
                    <nav id="top_nav">
                        <ul>
                            <li><a href="index.php" class="nav1">Home</a></li>          
                            <li><a href="contact_us.php" class="nav3">Contact</a></li>
                            <?php if (!empty($_SESSION['id'])) { ?>
                                <li><a href="profile.php" class="nav2">Profile</a></li>
                                <li><a href="change_password.php" class="nav3">Change Password</a></li>
                                <li><a href="logout.php" class="nav3">Logout</a></li>
                            <?php } ?>    
                        </ul>
                    </nav>
                </div>
                <nav>
                    <ul id="menu">
                        <li id="menu_active"><a href="index.php"><span><span>Home</span></span></a></li>
                        <?php if (empty($_SESSION['id'])) { ?>
                            <li><a href="railways_info.php"><span><span>Railways Info</span></span></a></li>
                            <li><a href="staff.php"><span><span>Staff</span></span></a></li>
                            <li><a href="contact_us.php"><span><span>Contact</span></span></a></li>
                            <li><a href="login.php"><span><span>Login</span></span></a></li>
                            <li><a href="registration.php"><span><span>Registration</span></span></a></li>
							
						<?php } else { ?>                            
                            <li><a href="railways_info.php"><span><span>Railways Info</span></span></a></li>
                            <li><a href="staff.php"><span><span>Staff</span></span></a></li>
                            <li><a href="contact_us.php"><span><span>Contact</span></span></a></li>
                            <li><a href="booked_ticket_listing.php"><span><span>Booking</span></span></a></li>
                            <li><a href="registration.php"><span><span>Registration</span></span></a></li>
							<li><a href="feedback.php"><span><span>Feedback</span></span></a></li>
                        <?php } ?>
                    </ul>
                </nav>
                <nav>
                    <ul id="menu">

<!--                        <li><a href="index.html"><span><span>About</span></span></a></li>

<li><a href="offers.html"><span><span>Offers</span></span></a></li>
<li><a href="book.html"><span><span>Book</span></span></a></li>
<li><a href="services.html"><span><span>Services</span></span></a></li>
<li><a href="safety.html"><span><span>Safety</span></span></a></li>
<li class="end"><a href="contacts.html"><span><span>Contacts</span></span></a></li>-->
                    </ul>
                </nav>
            </header>
            <!-- / header -->