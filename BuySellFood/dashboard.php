<?php
session_start();


function update_quantity($id,$customer_order){
  include('connection.php');

 $sqq = "SELECT quantity FROM sell WHERE id=?";
      $stm = $db8->prepare($sqq);
      $stm->bind_param('i',$id);
      $stm->execute();
      $stm->bind_result($sub_quantity);
      $stm->fetch();
      
      $update_value= (int)$sub_quantity-(int)$customer_order;
 
        
  $stmt1 = $db1->prepare("UPDATE sell SET quantity=? WHERE id = ?");
				$stmt1->bind_param('si',$update_value,$id);
				$stmt1->execute(); 
				$stmt1->close();  
}

if (isset($_POST['confirm_pickup_submit'])) {
  if (isset($_POST['customer_order']) && !empty($_POST['customer_order'])){
    
    date_default_timezone_set("America/Belize");
    $time=time();
    $food_id= $_POST['pick_id'];
    $customer_order= $_POST['customer_order'];
    
    include ('connection.php');
    $in1= $db3->prepare("INSERT INTO orders(orders_quantity,customer_phone,food_id,timestamp) VALUES (?,?,?,?)");
    $in1->bind_param ('ssss',$customer_order,$_SESSION['phone'],$food_id,$time);
		if($in1->execute())
		{
		  update_quantity($food_id,$customer_order);
		  $GLOBALS['order_confirmed']=true;
	
		  
	  }
  }
    else{
      $GLOBALS['null_quantity']=true;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.1/css/materialize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" /></link>
 
  <link rel="stylesheet" href="css/cards.css">
  <link rel="stylesheet" href="css/flash.css">
  
    <title>Dashboard</title>
</head>
<body>
  <?php include('header.php') ?>
  <main class="container">
    <div class="row section">
      <div class="col s12">
        <?php 
      
    
  
          date_default_timezone_set("America/Belize");
          //Sql to fetch all the posted food. 
          include('connection.php');
          $sq = "SELECT id,phone,file,name,description,location,category,spicy,type,price,quantity,timestamp FROM sell WHERE quantity>0 ORDER BY timestamp DESC";
          $st = $db3->prepare($sq);
          $st->execute();
          $st->bind_result($id,$phone, $file, $name, $description, $location, $category, $spicy, $type, $price, $quantity, $timestamp);
          while ($st->fetch()) {
            $name        = ucwords(strtolower($name));
            $description = ucwords(strtolower($description));
            $category    = ucwords(strtolower($category));
            $type        = ucwords(strtolower($type));
        ?>
          <!--Card Container -->
            <div class="card">
              <div class="card-image" style="width:37%">
                <img class="activator" src="upload/<?php print $file;?>">
                <div class="card-title"><?php print $name; ?></div>
              </div>
              <div class="card-content activator">
                <?php print $description; ?>
                
                <div class="circle-container">
                    <h5>Orders Left &nbsp  <?php print $quantity; ?></h5>
                    <h5>Price &nbsp $<?php print $price; ?></h5>
                </div>
                <span>Click on the image to see more details</span>
              </div>

              <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">
                  <?php
print $name;
?>
                 <br>
                  <br>
                  <i class="material-icons right">close</i>
                </span>

                <?php
print $description;
print "<br><br>";

print "Seller's Phone: " . $phone;
print "<br>";
print "Pick up location: " . $location;

print "<br><br>";


print "Category: " . $category;
print "<br>";
print "Type: " . $type;
print "<br>";
print "Spicy: " . $spicy;
print "<br>";
print "Price: $" . $price;
print "<br><br><br>";
print "Posted Date: ";
print date('jS  F Y', $timestamp);
print "<br>";
print "Posted Time: ";
print date('h:i:s A', $timestamp);
?>
                 <br>
              </div>

              <div class="card-action">
                      
      <form action="" method="POST">
        <input type="hidden" id="pick_id" name="pick_id" value="<?php print $id ?>">
        <input class="col s6 validate" type="number" required name="customer_order" placeholder="Number of orders you want to place"/>
        <br><br><br>
        <button class="btn waves-effect waves-light blue-grey" type="submit" name="confirm_pickup_submit">Confirm Pickup</button>
      </form>
              
              </div>
            </div>
          
        
      
      <!--Card Container ends -->
      <?php
}
?>

        
      </div>
    </div>
  </main>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.1/js/materialize.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  
  <script src="js/confirm_popup.js"></script>


</body>
</html>