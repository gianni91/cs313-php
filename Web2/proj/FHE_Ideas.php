<?php 
session_start();
require '../dbConnector.php';

if (!isset($_SESSION["loggedIn"])) {
	$_SESSION["loggedIn"] = "false";
}

try 
{
	$db = loadDatabase("fhe_ideas");
}
catch (PDOException $theError)
{
	echo 'Error: ' . $theError->getMessage();
	die();					// Kills the program if it didn't work?
}
?>

<html>
<head>
  <title> Fhe Ideas </title>
  <script>

	function addIdea() {
          <?php 
	    if ($_SESSION["loggedIn"] == "true") { 
 		echo 'window.location.href="Add_Idea.php";' ;
	    } else {
		echo 'window.location.href="log_in.html";' ;
	    } 
          ?>

	}	

	function deleteIdea() {
          <?php 
  	    if ($_SESSION["loggedIn"] == "true") { 
		echo 'window.location.href="Delete_Idea.php";' ;
 	    } else {
		echo 'window.location.href="log_in.html";' ;
	    } 
          ?>
	}

  </script>
</head>

<body style="background-image:url(Images/IdahoFalls2.png); background-attachment:fixed; background-size: 100% 100% ;background-repeat:no-repeat" > 

  <div align="center">
    <h1 id="text"> Rexburg Home Evening Ideas </h1>
    <button type="button" onclick="addIdea()"> Add Idea </button>
    <button type="button" onclick="deleteIdea()"> Delete Idea </button> 
   
  </div>


  <div style = "margin: 40px; padding:20px; background-color:rgba(250,250,250,0.8); border-radius:25px">

     <?php

//	$statement = $db->QUERY('SELECT t1.description, t1.g_id, t2.category FROM general_ideas as t1 JOIN categories as t2 ON t1.category = t2.c_id');
	$statement = $db->QUERY('SELECT description, g_id, category FROM general_ideas');

	echo '<table style="table-layout:fixed" cellpadding="10" id="table1">';

	WHILE ($oneRow = $statement->FETCH(PDO::FETCH_ASSOC))
	{
		echo '<tr><td colspan="4" style="font-size:120%"><strong>' . $oneRow['description'] . '</strong></td></tr>';

		$index = $oneRow['g_id'];

		$statement0 = $db->QUERY("SELECT t1.gd_id, t2.description, t2.address, t2.car_needed, t2.min_price, t2.max_price, t2.travel_time, t2.contact FROM idea_details_key as t1 JOIN details as t2 ON t1.d_id = t2.d_id WHERE t1.gd_id = $index");

		WHILE ($oneRow0 = $statement0->FETCH(PDO::FETCH_ASSOC))
		{

		    echo '<tr><td valign="top" colspan="2"><div style = "margin-left: 30px; font-size:110%">&#10146 '.$oneRow0['description'] .'</div></td><td></td>';

			if($oneRow0['max_price'] != 0)
			{
			   echo '<td valign="top" style="width:60px"> $'.$oneRow0['min_price'].' - '.$oneRow0['max_price'] .'</td>';
			} else 
			{
			   echo '<td> Free </td>';
			}

			
			if ($oneRow0['travel_time'] != 0) {
				echo '<td valign="top" style="width:48px"> '.$oneRow0['travel_time'] .' min. </td>';
			
		  	  if ($oneRow0['car_needed'] == 0) {
				echo '<td valign="top"><image src="Images/walk.png" width="45" alt="walking"></td>';
			  } else {
				echo '<td valign="top"><image src="Images/car.png" width="45" alt="driving"></td>';
			  }
			} else {
				echo '<td> </td>';
			}

			echo '</tr>';

			if ( $oneRow0['address'] != NULL && $oneRow0['contact'] != NULL && (strlen(trim($oneRow0['address'])) > 0 || strlen(trim($oneRow0['contact'])) > 0 ))
			{	
			   if($oneRow0['address'] != NULL && strlen(trim($oneRow0['address'])) > 0)
			   {
				echo '<td valign="top"><div style = " margin-left: 150px"><image src="Images/compass.png" style="width:22" alt="Location: " align="left"> '.$oneRow0['address'].'</div></td>';
			   } else 
			   {
			      echo '<td>  </td>';
			   }
			   if($oneRow0['contact'] != NULL && strlen(trim($oneRow0['contact'])) > 0)
			   {
				echo '<td><image src="Images/phone2.png" style="width:22" alt="Contact: " align="left"> '.$oneRow0['contact'].'</td>';
			   }
			   else {
				echo '<td> </td>';
			   }

			   echo '</tr>';
			}

		}
          }
 	  echo '</table>';
       ?>
  </div>
  
</body>
</html>