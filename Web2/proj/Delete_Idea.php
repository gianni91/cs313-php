<?php 
session_start();
require '../dbConnector.php';

try 
{
	$db = loadDatabase("fhe_ideas");
}
catch (PDOException $theError)
{
	echo 'Error: ' . $theError->getMessage();
	die();
}
?>

<html>
<head>
  <title> Delete Idea </title>
  <script>

	// Return to the display page by pushing the cancel button
	function cancel() {
		window.location="FHE_Ideas.php";
	}

  </script>
</head>

<body style="background-image:url(Images/IdahoFalls2.png); background-attachment:fixed; background-size: 100% 100% ;background-repeat:no-repeat" > 

   <h1 style="text-align:center"> Remove an Idea </h1>

  <form action="remove_from_database.php" method="POST">
  <div style = "margin: 40px; padding:20px; background-color:rgba(250,250,250,0.8); border-radius:25px">

     Select a Specific Idea <br />
     <select name="selectDetailedDescription" id="selectDetailedDescription" style="width:560px">
	  <option value="None"> </option>

	// Show all of the existing specific ideas in the select list
	<?php $statement = $db->QUERY('SELECT description, d_id FROM details');
	WHILE ($oneRow = $statement->FETCH(PDO::FETCH_ASSOC))
	{
		echo '<option value="'. htmlspecialchars($oneRow['description']) . '" style="width:550px">' . $oneRow['description'] . '</option>';
        }
	?>

     </select><br /><br />

     Or <br /><br />

     Select a General Idea <br />
     <select name="selectGeneralDescription" id="selectGeneralDescription" >
	  <option value="None"> </option>

	// Show all of the existing general ideas in the select list 
	<?php $statement = $db->QUERY('SELECT description, g_id, category FROM general_ideas');
	WHILE ($oneRow = $statement->FETCH(PDO::FETCH_ASSOC))
	{
		echo '<option value="'. htmlspecialchars($oneRow['description']) . '">' . $oneRow['description'] . '</option>';
        }
	?>

     </select><br /><br />





     <input type="submit" value="Delete">
     <button type="button" onclick="cancel()">Cancel</button>

   </div>

   <input type="hidden" name="submitType" id="submitType" value="1" />

   </form>

</body>
</html>