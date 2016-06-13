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

$general_idea   = $_POST['selectGeneralDescription'];

// This variable keeps track of the idea id
$idea_num = 0; 

// Get the id from the chosen idea
$statement = $db->PREPARE('SELECT g_id FROM general_ideas WHERE description = :general_idea');
$statement->bindValue(':general_idea', $general_idea, PDO::PARAM_INT);
$statement->execute();
$values = $statement->FETCHALL(PDO::FETCH_ASSOC);
$idea_num = $values[0]['g_id'];

// Delete the idea from the general_ideas list
$statement2 = $db->PREPARE('DELETE FROM general_ideas WHERE :general_idea = description');
$statement2->bindValue(':general_idea', $general_idea, PDO::PARAM_INT);
$statement2->execute();

// Delete associated keys in the idea_details_key table
$statement3 = $db->PREPARE('DELETE FROM idea_details_key WHERE :idea_num = gd_id');
$statement3->bindValue(':idea_num', $idea_num, PDO::PARAM_INT);
$statement3->execute();

header('Location:FHE_Ideas.php');
?>
