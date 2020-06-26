<?php
session_start();
include("connection.php");

$mrArr= array();
$food_name= array();
$food_description= array();
$food_category= array();
$food_location= array();
   
  $sqq = "SELECT phone,name,description,location,category FROM sell" ; 
			$st= $db4->prepare($sqq);
			$st-> execute();
			$st-> bind_result($phone,$name,$description,$location,$category);
  while($st->fetch()) {
    $name = ucwords(strtolower($name));
    $description = ucwords(strtolower($description));
    $category = ucwords(strtolower($category));
    $location = ucwords(strtolower($location));
    
    
    // Seperate arrays for the view of the search data
    $food_name[]=$name; 
    $food_description[]=$description;
    $food_category[]= $category;
    $food_location[] = $location; 
    
    // Same array for the js autocomplete search
    $myArr[] =$name;
    $myArr[] =$description;
    $myArr[] =$category;
    $myArr[] =$location;
  }
  
  $_SESSION['food_name'] = $food_name;
  $_SESSION['food_description'] = $food_description;
  $_SESSION['food_category'] = $food_category;
  $_SESSION['food_location'] = $food_location;
  $_SESSION['myArr'] = $myArr;


$myJSON = json_encode($myArr);

echo $myJSON;
        
//https://stackoverflow.com/questions/39883425/materialize-autocomplete-with-dynamic-data-in-jquery-ajax
?>