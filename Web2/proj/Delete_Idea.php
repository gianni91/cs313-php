<?php 
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

<body style="background-image:url(IdahoFalls2.png); background-attachment:fixed; background-size: 100% 100% ;background-repeat:no-repeat" > 

   <h1 style="text-align:center"> Remove an Idea </h1>

  <form action="remove_from_database.php" method="POST">
  <div style = "margin: 40px; padding:20px; background-color:rgba(250,250,250,0.8); border-radius:25px">

     Select one 
     <select name="selectGeneralDescription" id="selectGeneralDescription">

	// Show all of the existing general ideas in the select list 
	<?php $statement = $db->QUERY('SELECT description, g_id, category FROM general_ideas');
	WHILE ($oneRow = $statement->FETCH(PDO::FETCH_ASSOC))
	{
		echo '<option value="'. $oneRow['description'] . '">' . $oneRow['description'] . '</option>';
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