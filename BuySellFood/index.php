<?php
if (isset($_POST['submit'])) {
$phone= strtolower(trim($_POST['phone']));
$phone= preg_replace('/[^0-9]/', '', $phone);
$zip= strtolower(trim($_POST['zip']));

function insert_phone_db($phone,$zip){
session_start();
include ('connection.php');

if (!empty($zip)){
        if (!empty($phone))
        {	
        date_default_timezone_set("America/Belize"); 
        $time=time();
        $insert= $db->prepare("INSERT INTO phone(zip,phone,timestamp) VALUES (?,?,?)");
        $insert->bind_param ('ssi',$zip,$phone,$time);
		if($insert->execute())
	    {   
	        $_SESSION['zip']=$zip;
			$_SESSION['phone']=$phone;
			$_SESSION['time']=$time;
		    }
        }
    }
}

function database_has_phone($phone,$zip){
    include ('connection.php');
    $count=0;
	$sq = "SELECT id,zip,phone FROM phone WHERE zip=? AND phone=?" ; 
		$stat= $db3->prepare($sq);
		$stat-> bind_param('ss',$zip,$phone);
		$stat-> execute();
		$stat-> bind_result($id,$zip,$phone);
		while($stat->fetch()) {
		    $count++;
		}
        if ($count>0){
            return "true";
        }
        return "false";
}

function validate($phone,$zip){
session_start();
$_SESSION['zip_error']=false;
$_SESSION['phone_error']=false;

if(isset($_POST['zip'])){
  if (isset($_POST['phone'])){
      if (strlen($zip)==5){
        if (strlen($phone)==10){
            if(database_has_phone($phone,$zip)=="false"){
                insert_phone_db($phone,$zip);
            }
             header ('Location:dashboard.php');
        }
        else{
            $GLOBALS['phone_error']= true;
        }
     
    }
        else {
            session_start();
            $GLOBALS['zip_error']= true;
                }
        }
    }
}

validate($phone,$zip);
}?>


<html>
  <head>
    <title>ExpressFood</title>
    
    <!-- Material Design sources-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <!--ends-->
    
     <link rel="stylesheet" href="css/styles.css">
     <script src="js/auto.js"></script>
      
     <script src="js/video.js"></script>
     <link rel="stylesheet" href="css/video.css">
       <link rel="stylesheet" href="css/flash.css">

    <div class="header">
        <video poster="https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/polina.jpg" id="bgvid" playsinline autoplay muted loop>
            <!-- <source src="videos/slowmotion.webm" type="video/webm"> -->
             <source src="videos/slowmotion.mp4" type="video/mp4"> 
        </video>
    </div>


<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
body {font-family: Serif;}
</style>
<body>
<?php 
include('flash.php');
error_reporting(0);
if ($GLOBALS['zip_error']){
  flash( 'zip_error', 'Invalid Zip code', 'error-msg' );  
  flash( 'zip_error' );
}
error_reporting(0);
if ($GLOBALS['phone_error']){
  flash( 'phone_error', 'Invalid Phone number', 'error-msg' );  
  flash( 'phone_error' );
}
?>
    
    
<!-- Navbar (sit on top) -->

<!-- Page content -->

<br>

<div class="small_container">
<div class = "head">
    ExpressFood
</div>


<!-- FORM FIELDS-->
<form action= "" method="post"><br>
 <div class="card_container">
    <div class="card card-1">
        <div style="font-size:20px;font:sans-serif;color:#001f3f;">Sign In/ Sign Up</div>
        <div class="mdl-textfield mdl-js-textfield">
        

            <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name="zip" id="zip" required="required" placeholder="Zip Code" maxlength="5" />
            <label class="mdl-textfield__label" for="zip" > Zip Code:</label>
         
        </div>
        <br>
    
   
        <div class="mdl-textfield mdl-js-textfield">
            
            <label class="mdl-textfield__label" for="phone"> Phone Number:</label>
            <input class="mdl-textfield__input" type="text"  name="phone" id="phone" placeholder="(123) 456-7890"  required="required" onkeydown="javascript:backspacerDOWN(this,event);" onkeyup="javascript:backspacerUP(this,event);"/>
        </div>
        
          <button type="submit" name="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
          <div>Browse</div>
        </button>
    </div>
        <br>

      
    </div>
</div>
</form>
<!--ENDS-->


<!-- Text Div -->
<div class="white_container" id="white_container"><br>
    <div class="text">
        <h2>About</h2>
        <hr>
        <br>
         <h4>Buy and sell homemade food.<h4>
        <br>

        Find good food around you and<br> conform your order with a text 
    </div>
</div>

<div class="black_container">
</div>
 
</body>
</html>
   

 
</body>
</html>




