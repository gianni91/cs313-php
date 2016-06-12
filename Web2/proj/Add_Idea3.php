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
	die();					// Kills the program if it didn't work?
}


$general_idea   = $_POST['general_idea'];
$custom_idea    = $_POST['custom_idea'];
$activity_level = $_POST['activity_level'];
$category       = $_POST['category'];

$idea_num = 0;

echo 'the general idea is: '.$general_idea.'<br />';

if ($general_idea == "Custom") {   

	$statement6 = $db->PREPARE('SELECT g_id FROM general_ideas WHERE description = :custom_idea');
	$statement6->bindValue(':custom_idea', $custom_idea, PDO::PARAM_INT);
	$statement6->execute();
	$values = $statement6->FETCHALL(PDO::FETCH_ASSOC);

     if (sizeOf($values) < 1) {        
	$statement = $db->PREPARE('INSERT INTO general_ideas VALUES (NULL, :description, :activity_level, :category)');
	$statement->bindValue(':description', $custom_idea, PDO::PARAM_INT);
	$statement->bindValue(':activity_level', $activity_level, PDO::PARAM_INT);
	$statement->bindValue(':category', $category, PDO::PARAM_INT);
	$statement->execute();

	$idea_num = $db->lastInsertId();
     } else {
	$idea_num = $values[0]['g_id'];
     }

} else {
echo 'the custom idea is: '.$custom_idea.'<br />';
	$statement5 = $db->PREPARE('SELECT g_id FROM general_ideas WHERE description = :general_idea');
	$statement5->bindValue(':general_idea', $general_idea, PDO::PARAM_INT);
	$statement5->execute();
	$values = $statement5->FETCHALL(PDO::FETCH_ASSOC);
	$idea_num = $values[0]['g_id'];
//	echo 'the id of the general idea is '.$values[0]['g_id'].'<br />';
}
echo 'the idea number is: '.$idea_num.'<br />';

echo $general_idea.' '.$custom_idea.' '.$activity_level.' '.$category;

$details        = $_POST['ideaInput'];
$min_cost       = $_POST['minCostInput'];
$max_cost       = $_POST['maxCostInput'];
$car            = $_POST['carInput'];
$travel_time    = $_POST['travelTimeInput'];
$address        = $_POST['addressInput'];
$contact        = $_POST['contactInput'];

echo $details.' '.$min_cost.' '.$max_cost.' '.$car.' '.$travel_time.' '.$address.' '.$contact;

$statement2 = $db->PREPARE('INSERT INTO details VALUES (NULL, :details, :address, :contact, :travel_time, :min_cost, :max_cost, :car)');
$statement2->bindValue(':details', $details, PDO::PARAM_INT);
$statement2->bindValue(':address', $address, PDO::PARAM_INT);
$statement2->bindValue(':contact', $contact, PDO::PARAM_INT);
$statement2->bindValue(':travel_time', $travel_time, PDO::PARAM_INT);
$statement2->bindValue(':min_cost', $min_cost, PDO::PARAM_INT);
$statement2->bindValue(':max_cost', $max_cost, PDO::PARAM_INT);
$statement2->bindValue(':car', $car, PDO::PARAM_INT);
$statement2->execute();


$detail_num = $db->lastInsertId();
echo "The id of the details inputted is $detail_num";


/*
$statement3 = $db->PREPARE('SELECT FROM general_ideas VALUES (:start, :finish)');
$statement3->bindValue(':details', $details, PDO::PARAM_INT);
$statement3->execute();
*/

$statement4 = $db->PREPARE('INSERT INTO idea_details_key VALUES (:idea_num, :detail_num)');
$statement4->bindValue(':idea_num', $idea_num, PDO::PARAM_INT);
$statement4->bindValue(':detail_num', $detail_num, PDO::PARAM_INT);
$statement4->execute();


echo $details.' '.$min_cost.' '.$max_cost.' '.$car.' '.$travel_time.' '.$address.' '.$contact;
header('Location:FHE_Ideas.php');
?>