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

$general_idea   = $_POST['selectGeneralDescription'];
$custom_idea    = $_POST['ideaInput'];
$activity_level = $_POST['activityLevelInput'];
$category       = $_POST['categoryInput'];
$submitType     = $_POST['submitType'];


if ($general_idea == "Custom") {
	$statement6 = $db->PREPARE('SELECT g_id FROM general_ideas WHERE description = :custom_idea');
	$statement6->bindValue(':custom_idea', $custom_idea, PDO::PARAM_INT);
	$statement6->execute();
	$values = $statement6->FETCHALL(PDO::FETCH_ASSOC);

    if ($submitType == 0 ) {
      if (sizeOf($values) < 1) {
	$statement = $db->PREPARE('INSERT INTO general_ideas VALUES (NULL, :description, :activity_level, :category)');
	$statement->bindValue(':description', $custom_idea, PDO::PARAM_INT);
	$statement->bindValue(':activity_level', $activity_level, PDO::PARAM_INT);
	$statement->bindValue(':category', $category, PDO::PARAM_INT);
	$statement->execute();
      }  
      header('Location:FHE_Ideas.php');	
    }
} 


//echo 'submit type: '.$submitType;




?>

<html>
<head>
  <title> Add FHE Idea </title>
  <script>


  </script>
</head>

<body style="background-image:url(IdahoFalls2.png); background-attachment:fixed; background-size: 100% 100% ;background-repeat:no-repeat" > 


   <h1 style="text-align:center"> Add or Remove Ideas </h1>


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
   <textarea name="ideaInput" id="ideaInput" cols="70" maxlength="1000" style="font-family:ariel"> </textarea> <br><br>

   Minimum Cost (per person) - If you have needed supplies or can borrow them<br>
   $<input type="number" id="minCostInput" name="minCostInput" value="0"></input><br><br>

   Maximum Cost (per person) - If you have to buy or rent supplies<br>
   $<input type="number" id="maxCostInput" name="maxCostInput" value="0"></input><br><br>

   Is a car required? <br>
   <select id="carInput" name="carInput">
     <option value="0"> No </option>
     <option value="1"> Yes </option>
   </select><br><br>

   Travel Time (minutes)<br>
   <input type="number" name="travelTimeInput" id="travelTimeInput" value="0"></input><br><br>

   Address <br>
   <textarea id="addressInput" name="addressInput" cols="70" maxlength="200" style="font-family:ariel"> </textarea> <br><br>

   Contact Info - If you must contact someone in order to get the activity organized/reserved <br>
   Include: Organization/Name, Phone number<br>
   <textarea id="contactInput" name="contactInput" cols="70" maxlength="200" style="font-family:ariel"> </textarea> <br><br>


   <input type="submit" value="Add">
   </div>
   <input type="hidden" name="general_idea" id="general_idea" value="<?php echo $general_idea ?>" />
   <input type="hidden" name="custom_idea" id="custom_idea" value="<?php echo $custom_idea ?>" />
   <input type="hidden" name="activity_level" id="activity_level" value="<?php echo $activity_level ?>" />
   <input type="hidden" name="category" id="category" value="<?php echo $category ?>" />

   </form>

   <div id="testDiv"></div>
  


</body>
</html>