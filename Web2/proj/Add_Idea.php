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
  <title> Add FHE Idea </title>
  <script>

	// Makes sure the correct fields are filled out before allowing the user to submit
	function verifyInput(submitType) {

	   if(document.getElementById("selectGeneralDescription").value == "Custom") {

 	      if (!document.getElementById("ideaInput").value.match(/\w/) || document.getElementById("activityLevelInput").value == "None" || document.getElementById("categoryInput").value == "None")
	      {
		   return false;
	      } 

           } 
	
	   // Stores whether the user wants to add the general idea only, or to add a detailed idea with it
	   document.getElementById("submitType").value = submitType;

	   return true; 
	}

  </script>
</head>

<body style="background-image:url(Images/IdahoFalls2.png); background-attachment:fixed; background-size: 100% 100% ;background-repeat:no-repeat" > 

   <h1 style="text-align:center"> Add an Idea </h1>

   <form action="Add_Idea2.php" method="POST">
   <div style = "margin: 40px; padding:20px; background-color:rgba(250,250,250,0.8); border-radius:25px">

      Select one 

      <select name="selectGeneralDescription" id="selectGeneralDescription">
         <option value="Custom">  </option>

	 <?php 

	    // Creates select options from the current general ideas 
	    $statement = $db->QUERY('SELECT description, g_id, category FROM general_ideas');
	    WHILE ($oneRow = $statement->FETCH(PDO::FETCH_ASSOC))
	    {
		echo '<option value="'. $oneRow['description'] . '">' . $oneRow['description'] . '</option>';
            }
         ?>

      </select><br /><br />

      or <br /><br />

      General Activity Description <br />
      <textarea id="ideaInput" name="ideaInput" maxlength="60" cols="60" rows="1" style="font-family:ariel"></textarea> <br /><br />

      Activity Level<br />
      <select name="activityLevelInput" id="activityLevelInput">
        <option value="None"> </option>
        <option value="Relaxed"> Relaxed </option>
        <option value="Average"> Average </option>
        <option value="Active"> Active </option>
      </select><br><br>

      Category <br>

      <select name="categoryInput" id="categoryInput" >
         <option value="None"></option>
         <option value="Outdoors"> Outdoors </option>
         <option value="Game"> Game </option>
         <option value="Skill"> Skill </option>
         <option value="Service"> Service </option>
         <option value="Educational"> Educational </option>
         <option value="Other"> Other </option>
      </select><br><br>

      <input type="submit" value="Add Details" onClick="return verifyInput(1)">
      <input type="submit" value="Finish" onClick="return verifyInput(0)">

   </div>

   <input type="hidden" name="submitType" id="submitType" value="1" />

   </form>

</body>
</html>