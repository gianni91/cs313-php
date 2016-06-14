<?php 

require '../dbConnector.php';

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
		window.location.href="Add_Idea.php";
	}

	function deleteIdea() {
		window.location.href="Delete_Idea.php";
	}

  </script>
</head>

<body style="background-image:url(IdahoFalls2.png); background-attachment:fixed; background-size: 100% 100% ;background-repeat:no-repeat" > 

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

		    echo '<tr><td colspan="2"><div style = "margin-left: 30px">'.$oneRow0['description'] .'</div></td><td></td>';  //TODO

			if($oneRow0['max_price'] != 0)
			{
			   echo '<td> $'.$oneRow0['min_price'].' - '.$oneRow0['max_price'] .'</td>';
			} else 
			{
			   echo '<td> FREE </td>';
			}

			
			if ($oneRow0['travel_time'] != 0) {
				echo '<td> '.$oneRow0['travel_time'] .' min. ';
			
		  	  if ($oneRow0['car_needed'] == 0) {
				echo 'walking</td>';
			  } else {
				echo 'driving</td>';
			  }
			} else {
				echo '<td> </td>';
			}

			echo '</tr>';

			if ( $oneRow0['address'] != NULL && $oneRow0['contact'] != NULL)
			{	
			   if($oneRow0['address'] != NULL && strlen(trim($oneRow0['address'])) > 0)
			   {
				echo '<td><div style = "margin-left: 150px">Location: '.$oneRow0['address'].'</div></td>';
			   } else 
			   {
			      echo '<td>  </td>';
			   }
			   if($oneRow0['contact'] != NULL && strlen(trim($oneRow0['contact'])) > 0)
			   {
				echo '<td> Contact: '.$oneRow0['contact'].'</td>';
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