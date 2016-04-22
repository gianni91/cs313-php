<html>
  <head> 
    <title>Vote Form</title>
    <link rel = "stylesheet" type ="text/css" href = "myStyle2.css"></link>
  </head>
  <body>

<?php
   if(!isset($_COOKIE["submitted"]))
   {
      setcookie("submitted","false");   
   }
   else
   {
   	if($_COOKIE["submitted"] == "true")
   	{
      	  header("Location: voteResults.php");
   	}	
   }
?>

     <h1 align="center"> Class Preference Survey </h1>
     <form  id="voteForm" action="voteResults.php" method="post" >
	Do you prefer to have a few large projects or a lot of individual conceptual assignments? <br>
	<input type="radio" name="work" value="bigProjects"> Big Projects <br>
	<input type="radio" name="work" value="smallAssignments"> Small Assignments <br>
	<input type="radio" name="work" value="undecided"> Undecided <br><br>
	
	Do you prefer classes online or in person? <br>
	<input type="radio" name="class" value="online"> Online <br>
	<input type="radio" name="class" value="inPerson"> In Person <br>
	<input type="radio" name="class" value="undecided"> Undecided <br><br>

	Do you prefer to start classes before or after 10am? <br>
	<input type="radio" name="wake" value="before"> Before <br>
	<input type="radio" name="wake" value="after"> After <br>
	<input type="radio" name="wake" value="undecided"> Undecided <br><br>
	
	Do you prefer to have a lot of classes on three days of the week or to have a few classes per day five days a week? <br>
	<input type="radio" name="schedule" value="threeDays"> Three days <br>
	<input type="radio" name="schedule" value="fiveDays"> Five days <br>
	<input type="radio" name="schedule" value="undecided"> Undecided <br><br>


	<input type = "submit" value="See Results" > </input>
	<input type = "reset" value="Clear Answers" > </input>
     </form>

  </body>
</html>
