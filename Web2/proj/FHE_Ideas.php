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

	function testDisplay() {
		
	}

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
	WHILE ($oneRow = $statement->FETCH(PDO::FETCH_ASSOC))
	{
		echo '<h3>' . $oneRow['description'] . '</h3>';
		echo '<div style = "margin-left: 30px">';
		$index = $oneRow['g_id'];

		$statement0 = $db->QUERY("SELECT t1.gd_id, t2.description FROM idea_details_key as t1 JOIN details as t2 ON t1.d_id = t2.d_id WHERE t1.gd_id = $index");

		WHILE ($oneRow0 = $statement0->FETCH(PDO::FETCH_ASSOC))
		{

			echo ' - '.$oneRow0['description'] . '<br /><br />';
		}
		echo '</div>';
       }
       ?>
  </div>


<!--
    Category: 
    <input type="checkbox" id="sOutdoors" checked="checked"> Outdoors
    <input type="checkbox" id="sGame" checked="checked"> Game
    <input type="checkbox" id="sSkill" checked="checked"> Skill
    <input type="checkbox" id="sService" checked="checked"> Service
    <input type="checkbox" id="sEducational" checked="checked"> Educational
    <input type="checkbox" id="sOther" checked> Other <br>
    Activity level: 
    <input type="checkbox" id="sRelaxed" checked="checked"> Relaxed
    <input type="checkbox" id="sAverage" checked="checked"> Average 
    <input type="checkbox" id="sActive" checked> Active <br>
    Conditions: 
    <input type="checkbox" id="sNoCar" > No Car 
    <input type="checkbox" id="sNoTravel" > No Travel 
    <input type="checkbox" id="sNoCost" > No Cost <br>


    <br><button type="button" > Filter </button><br><br>
-->

   <div id="testDiv"></div>
  


</body>
</html>