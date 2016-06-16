<?php 
session_start();
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

$detailed_idea   = $_POST['selectDetailedDescription'];
$general_idea   = $_POST['selectGeneralDescription'];

if($detailed_idea != "None")
{

// This variable keeps track of the idea id
$idea_num = 0; 

// Get the id from the chosen idea
$statement = $db->PREPARE('SELECT d_id FROM details WHERE description = :detailed_idea');
$statement->bindValue(':detailed_idea', $detailed_idea, PDO::PARAM_INT);
$statement->execute();
$values = $statement->FETCHALL(PDO::FETCH_ASSOC);
$idea_num = $values[0]['d_id'];

// Delete the idea from the details list
$statement2 = $db->PREPARE('DELETE FROM details WHERE :detailed_idea = description');
$statement2->bindValue(':detailed_idea', $detailed_idea, PDO::PARAM_INT);
$statement2->execute();

// Delete associated keys in the idea_details_key table
$statement3 = $db->PREPARE('DELETE FROM idea_details_key WHERE :idea_num = d_id');
$statement3->bindValue(':idea_num', $idea_num, PDO::PARAM_INT);
$statement3->execute();

} else if ($general_idea != "None") {

// This variable keeps track of the idea id
$idea_num = 0; 

// Get the id from the chosen idea
$statement4 = $db->PREPARE('SELECT g_id FROM general_ideas WHERE description = :general_idea');
$statement4->bindValue(':general_idea', $general_idea, PDO::PARAM_INT);
$statement4->execute();
$values = $statement4->FETCHALL(PDO::FETCH_ASSOC);
$idea_num = $values[0]['g_id'];

// Delete the idea from the general_ideas list
$statement5 = $db->PREPARE('DELETE FROM general_ideas WHERE :general_idea = description');
$statement5->bindValue(':general_idea', $general_idea, PDO::PARAM_INT);
$statement5->execute();

// Delete details associated with the general idea 
$statement6 = $db->PREPARE('SELECT d_id FROM idea_details_key WHERE :idea_num = gd_id');
$statement6->bindValue(':idea_num', $idea_num, PDO::PARAM_INT);
$statement6->execute();
WHILE ($detail = $statement6->FETCH(PDO::FETCH_ASSOC))
{	
	$statement7 = $db->PREPARE('DELETE FROM details WHERE :detail = d_id');
	$statement7->bindValue(':detail', $detail['d_id'], PDO::PARAM_INT);
	$statement7->execute();
}


// Delete associated keys in the idea_details_key table
$statement8 = $db->PREPARE('DELETE FROM idea_details_key WHERE :idea_num = gd_id');
$statement8->bindValue(':idea_num', $idea_num, PDO::PARAM_INT);
$statement8->execute();

}


header('Location:FHE_Ideas.php');
?>
