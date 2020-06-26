<nav class="nav-extended">
    <div class="nav-wrapper">
      <a class="brand-logo" href="index.php">ExpressFood</a>  
         <ul id="nav-mobile" class="right hide-on-med-and-down">
        <?php //include('search.php') ?>
      </ul>
         
      <?php include('sidenav.php');?>
    </div>
    <div class="nav-content">
      <ul class="tabs tabs-transparent">
        <div class="row">
          <li class="tab col m6"><a href="dashboard.php" class="active">Dashboard</a></li>
          <li class="tab col m6"><a href="sell.php">Sell</a></li>
        </div>
      </ul>
       <?php
        include('flash.php');
          error_reporting(0);
      if ($GLOBALS['null_quantity']){
        flash( 'null_quantity', 'Please enter the number of orders', 'error-msg' );  
        flash( 'null_quantity' );
      }
       error_reporting(0);
       if ($GLOBALS['order_confirmed']){
        flash( 'order_confirmed', 'Your orders is confirmed.' );  
        flash( 'order_confirmed' );
      }
      
      ?>
    </div>
  </nav>