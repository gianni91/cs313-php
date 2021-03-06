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

// Recieve the values from the form
$general_idea   = $_POST['selectGeneralDescription'];
$custom_idea    = htmlspecialchars($_POST['ideaInput']);
$activity_level = $_POST['activityLevelInput'];
$category       = $_POST['categoryInput'];
$submitType     = $_POST['submitType'];

// If the user selected to add a custom idea rather than to choose from an existing one...
if ($general_idea == "Custom") {

	// See if the inputted idea matches one that already exists
	$statement6 = $db->PREPARE('SELECT g_id FROM general_ideas WHERE description = :custom_idea');
	$statement6->bindValue(':custom_idea', $custom_idea, PDO::PARAM_INT);
	$statement6->execute();
	$values = $statement6->FETCHALL(PDO::FETCH_ASSOC);

    // Only check this here if the user chose to submit the general idea only, and not to ad details
    if ($submitType == 0 ) {

      // If the inputted idea matches an existing idea, dno't add it to the database
      if (sizeOf($values) < 1) {
	$statement = $db->PREPARE('INSERT INTO general_ideas VALUES (NULL, :description, :activity_level, :category)');
	$statement->bindValue(':description', $custom_idea, PDO::PARAM_INT);
	$statement->bindValue(':activity_level', $activity_level, PDO::PARAM_INT);
	$statement->bindValue(':category', $category, PDO::PARAM_INT);
	$statement->execute();
      }  

      // Finish the idea adding process here insteading of continuing to add details
      header('Location:FHE_Ideas.php');	
    }
} 

?>

<html>
<head>
  <title> Add FHE Detail </title>
  <script>

	function verifyInput() {

	      // Makes sure that they put in an something for the idea
 	      if (!document.getElementById("ideaInput").value.match(/\w/))
	      {
		   return false;
	      } 
	
	   return true; 
	}

  </script>
</head>

<body style="background-image:url(Images/IdahoFalls2.png); background-attachment:fixed; background-size: 100% 100% ;background-repeat:no-repeat" > 

   <h1 style="text-align:center"> Add Details </h1>

<form action="Add_Idea3.php" method="POST">
 <div style = "margin: 40px; padding:20px; background-color:rgba(250,250,250,0.8); border-radius:25px">

   <?php 
	if ($general_idea == 'Custom') {
	      echo '<h2>'.$custom_idea.'</h2><br /><br />'; 
	} else {
	      echo '<h2>'.$general_idea.'</h2><br /><br />'; 
	}

   ?>

   Detailed Description <br />
   <textarea name="ideaInput" id="ideaInput" cols="70" maxlength="400" style="font-family:ariel"></textarea> <br><br>

   Minimum Cost (per person) - If you have needed supplies or can borrow them<br>
   $<input type="number" id="minCostInput" name="minCostInput" value="0" min="0" max="99"></input><br><br>

   Maximum Cost (per person) - If you have to buy or rent supplies<br>
   $<input type="number" id="maxCostInput" name="maxCostInput" value="0" min="0" max="99"></input><br><br>

   Is a car required? <br>
   <select id="carInput" name="carInput">
     <option value="0"> No </option>
     <option value="1"> Yes </option>
   </select><br><br>

   Travel Time (minutes)<br>on
   <input type="number" name="travelTimeInput" id="travelTimeInput" value="0" min="0" max="99"></input><br><br>

   Address <br>
   <textarea id="addressInput" name="addressInput" cols="70" maxlength="100" style="font-family:ariel"></textarea> <br><br>

   Contact Info - If you must contact someone in order to get the activity organized/reserved <br>
   Include: Organization/Name, Phone number<br>
   <textarea id="contactInput" name="contactInput" cols="70" maxlength="100" style="font-family:ariel"></textarea> <br><br>


   <input type="submit" value="Add" onClick="return verifyInput()">
   </div>
   <input type="hidden" name="general_idea" id="general_idea" value="<?php echo $general_idea ?>" />
   <input type="hidden" name="custom_idea" id="custom_idea" value="<?php echo $custom_idea ?>" />
   <input type="hidden" name="activity_level" id="activity_level" value="<?php echo $activity_level ?>" />
   <input type="hidden" name="category" id="category" value="<?php echo $category ?>" />

   </form>

   <div id="testDiv"></div>
  


</body>
</html>