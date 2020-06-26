<?php
if (isset($_POST['searchsubmit'])){
  session_start();
  $_SESSION['search_value']=$_POST['search_value'] ;
  header('location:gg.php');
}
?>




 <!-- Materialize css CDN-->
  <meta name="viewport" content="width = device-width, initial-scale = 1">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

  </script>
  <!-- Materialize css CDN ends-->
  <!-- Material Design sources-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <!--ends-->

  <link rel="stylesheet" href="css/cards.css">
<form method="POST">
  <div class="input-field">
    <input type="text" name="search_value" id="autocomplete-input" class="autocomplete" placeholder="Search">
    <button class="btn" type="submit" name="searchsubmit"><i class="fa fa-search fa-fw"></i></button>
  </div>
</form>



<script>
$(document).ready(function() {
  //Autocomplete
  $(function() {
    $.ajax({
      type: 'GET',
      url: 'searchdata.php',
      success: function(response) {
        console.log(response);
        var countryArray = response;
        var dataCountry = {};
        var mainArray=JSON.parse(countryArray);
        console.log(mainArray);
        for (var i = 0; i < mainArray.length; i++) {
          dataCountry[mainArray[i]] = mainArray[i].flag;
        }
        $('input.autocomplete').autocomplete({
          data: dataCountry,
          limit: 5, // The max amount of results that can be shown at once. Default: Infinity.
        });
      }
    });
  });
});
</script>


 