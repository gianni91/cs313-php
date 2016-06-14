<?php 
require '../dbConnector.php';

try 
{
	$db = loadDatabase("fhe_ideas");
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);	 	// So stuff isn't parsed before sending it to mySQL - http://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php
}
catch (PDOException $theError)
{
	echo 'Error: ' . $theError->getMessage();
	die();	
}

// Recieve the values obtained in the first idea page (for adding a general idea)
$general_idea   = $_POST['general_idea'];
$custom_idea    = htmlspecialchars($_POST['custom_idea']);
$activity_level = $_POST['activity_level'];
$category       = $_POST['category'];

// This variable will keep track of the id of the general idea, to be filled later
$idea_num = 0;

// If the user had inputted a custom general idea, instead of selecting one...
if ($general_idea == "Custom") {   

	// See if the inputted idea matches any idea already in the list
	$statement6 = $db->PREPARE('SELECT g_id FROM general_ideas WHERE description = :custom_idea');
	$statement6->bindValue(':custom_idea', $custom_idea, PDO::PARAM_INT);
	$statement6->execute();
	$values = $statement6->FETCHALL(PDO::FETCH_ASSOC);

     // If it doesn't match an existing idea from the list...
     if (sizeOf($values) < 1) {        

	// Add the custom idea to the database
	$statement = $db->PREPARE('INSERT INTO general_ideas VALUES (NULL, :description, :activity_level, :category)');
	$statement->bindValue(':description', $custom_idea, PDO::PARAM_INT);
	$statement->bindValue(':activity_level', $activity_level, PDO::PARAM_INT);
	$statement->bindValue(':category', $category, PDO::PARAM_INT);
	$statement->execute();

	// Store the id of the general id that was inserted 
	$idea_num = $db->lastInsertId();

     } else {

	// Store the id of the matching idea that was found
	$idea_num = $values[0]['g_id'];
     }

// If the user had selected an idea from the list
} else {

	// Find the id of that idea 
	$statement5 = $db->PREPARE('SELECT g_id FROM general_ideas WHERE description = :general_idea');
	$statement5->bindValue(':general_idea', $general_idea, PDO::PARAM_INT);
	$statement5->execute();
	$values = $statement5->FETCHALL(PDO::FETCH_ASSOC);
	$idea_num = $values[0]['g_id'];
}

// Get the variables that the user input into 'Add details" page 
$details        = htmlspecialchars($_POST['ideaInput']);
$min_cost       = $_POST['minCostInput'];
$max_cost       = $_POST['maxCostInput'];
$car            = $_POST['carInput'];
$travel_time    = $_POST['travelTimeInput'];
$address        = htmlspecialchars($_POST['addressInput']);
$contact        = htmlspecialchars($_POST['contactInput']);

// Add the detail to the database
$statement2 = $db->PREPARE('INSERT INTO details VALUES (NULL, :details, :address, :contact, :travel_time, :min_cost, :max_cost, :car)');
$statement2->bindValue(':details', $details, PDO::PARAM_INT);
$statement2->bindValue(':address', $address, PDO::PARAM_INT);
$statement2->bindValue(':contact', $contact, PDO::PARAM_INT);
$statement2->bindValue(':travel_time', $travel_time, PDO::PARAM_INT);
$statement2->bindValue(':min_cost', $min_cost, PDO::PARAM_INT);
$statement2->bindValue(':max_cost', $max_cost, PDO::PARAM_INT);
$statement2->bindValue(':car', $car, PDO::PARAM_INT);
$statement2->execute();

// Store the id of the detail added 
$detail_num = $db->lastInsertId();

// Associate the general idea with the detail by adding both values to the designated table as foreign keys 
$statement4 = $db->PREPARE('INSERT INTO idea_details_key VALUES (:idea_num, :detail_num)');
$statement4->bindValue(':idea_num', $idea_num, PDO::PARAM_INT);
$statement4->bindValue(':detail_num', $detail_num, PDO::PARAM_INT);
$statement4->execute();

// Go back to the idea display page 
header('Location:FHE_Ideas.php');

?>