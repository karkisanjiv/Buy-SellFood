<?php
include ('connection.php');
session_start();
$search_value=trim(strtolower($_SESSION['search_value']));
$main_array=array();
$helper_array =array();

$food_name=$_SESSION['food_name'];
$food_description=$_SESSION['food_description'];
$food_category=$_SESSION['food_category'];
$food_location=$_SESSION['food_location'];

foreach($_SESSION['myArr'] as $key){
	$key=trim(strtolower($key));
	$helper_array[]=$key;
}


if (in_array($search_value,$helper_array)){
		print "$search_value<br>";
		print_r($food_name);
	
	 foreach ($food_name as $element){
	 	$element=trim(strtolower($element));
	 	if (strcmp($search_value,$element)==0){
      $sq = "SELECT id FROM sell WHERE name=?";
			$st= $db->prepare($sq);
			$st-> bind_param('s',$search_value);
			$st-> execute();
			$st-> bind_result($id);
		  while($st->fetch()) {
		  	//print $id;
		    $main_array[]=$id;
			}
	}
 }
	
	foreach ($food_description as $element){
	 	$element=trim(strtolower($element));
	 	if (strcmp($search_value,$element)==0){
			$sq1 = "SELECT id FROM sell WHERE description=?";
			$st1= $db->prepare($sq1);
			$st1-> bind_param('s',$search_value);
			$st1-> execute();
			$st1-> bind_result($id);
		  while($st1->fetch()) {
		    $main_array[]=$id;
			}
	}
}
	
	 foreach ($food_category as $element){
	 	$element=trim(strtolower($element));
	 	if (strcmp($search_value,$element)==0){
	 		$sq2 = "SELECT id FROM sell WHERE category=?";
			$st2= $db->prepare($sq2);
			$st2-> bind_param('s',$search_value);
			$st2-> execute();
			$st2-> bind_result($id);
			while($st2->fetch()) {
		    $main_array[]=$id;
			}
	 	}
	}
	
	foreach ($food_location as $element){
	 	$element=trim(strtolower($element));
	 	if (strcmp($search_value,$element)==0){
		$sq1 = "SELECT id FROM sell WHERE location=?";
		$st1= $db->prepare($sq1);
		$st1-> bind_param('s',$search_value);
		$st1-> execute();
		$st1-> bind_result($id);
	  while($st1->fetch()) {
	    $main_array[]=$id;
			}
		}
	}
}
else {
	$search_value_array=explode(" ",$search_value);

	foreach ($search_value_array as $main){
		$main=trim($main);
	
	$sq11 = "SELECT id,name FROM sell";
		$st11= $db6->prepare($sq11);
		$st11-> execute();
		$st11-> bind_result($id,$name);
	  while($st11->fetch()) {
	  	$name = trim($name);
		$arr =(explode(" ",$name));	
		foreach ($arr as $e){
			$e=trim($e);
			if($e==$main){
		    $main_array[]=$id;
			}
		}
	}

	$sq22 = "SELECT id,description FROM sell";
		$st22= $db7->prepare($sq22);
		$st22-> execute();
		$st22-> bind_result($id,$description);
	  while($st22->fetch()) {
	  	$description = trim($description);
	  	$arr =(explode(" ",$description));	
		foreach ($arr as $e){
			$e=trim($e);
			if($e==$main){
		    $main_array[]=$id;
			}
		}
	}
	
	$sq33 = "SELECT id,location FROM sell";
		$st33= $db8->prepare($sq33);
		$st33-> execute();
		$st33-> bind_result($id,$location);
	  while($st33->fetch()) {
	  	$location = trim($location);
	  	$arr =(explode(" ",$location));	
		foreach ($arr as $e){
			$e=trim($e);
			if($e==$main){
		    $main_array[]=$id;
			}
		}
	}

	$sq44 = "SELECT id,category FROM sell";
		$st44= $db9->prepare($sq44);
		$st44-> execute();
		$st44-> bind_result($id,$category);
	  while($st44->fetch()) {
	  	$category = trim($category);
	  	$arr1 =(explode(" ",$category));	
		foreach ($arr1 as $e){
			$e=trim($e);
			if($e==$main){
		    $main_array[]=$id;
			}
		}
	}
		
		
	}
} 

$main_array=array_unique($main_array);
$_SESSION['main_array']= $main_array;

print_r($main_array);
?>
