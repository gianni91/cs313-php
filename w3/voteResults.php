<?php
  if(isset($_POST["work"]) && isset($_POST["class"]) && isset($_POST["wake"]) && isset($_POST["schedule"]))
  {
    setcookie("submitted","true");

    $vote1 = $_POST["work"];
    $vote2 = $_POST["class"];
    $vote3 = $_POST["wake"];
    $vote4 = $_POST["schedule"];

    $myFile = fopen("voteResults.txt", "r") or die("failed to open the file");
    $q1 = explode(" ",fgets($myFile));

    if ($vote1 == "bigProjects" )
	$q1[0] += 1;
    elseif ($vote1 == "smallAssignments" )
	$q1[1] += 1;
    else
	$q1[2] += 1;

    if ($vote2 == "online" )
	$q1[3] += 1;
    elseif ($vote2 == "inPerson" )
	$q1[4] += 1;
    else
	$q1[5] += 1;

    if ($vote3 == "before" )
	$q1[6] += 1;
    elseif ($vote3 == "after" )
	$q1[7] += 1;
    else
	$q1[8] += 1;

    if ($vote4 == "threeDays" )
	$q1[9] += 1;
    elseif ($vote4 == "fiveDays" )
	$q1[10] += 1;
    else
	$q1[11] += 1;
    

    fclose($myFile);

    $myFile2 = fopen("voteResults.txt", "w") or die("failed to open the file");
    fwrite($myFile2,"$q1[0] $q1[1] $q1[2] $q1[3] $q1[4] $q1[5] $q1[6] $q1[7] $q1[8] $q1[9] $q1[10] $q1[11]");
    fclose($myFile2);
  }

  $myFile = fopen("voteResults.txt", "r") or die("failed to open the file");

  $q1 = explode(" ",fgets($myFile));

  fclose($myFile);
?>


<!DOCTYPE html>
<head>
  <title> Results </title>
  <link rel = "stylesheet" type ="text/css" href = "myStyle.css"></link>
</head>
<body style="text-align:center; background-image:url(fabric_of_squares_gray.png)" >  <!-- Texture from http://subtlepatterns.com/?s=fabric -->
  <h1 align="center"> Vote Results </h1>

	Do you prefer to have a few large projects or a lot of individual conceptual assignments? <br><br>
        <tab> <table border = "1" cellpadding="3px">
	<tr>
	   <td width = "80%"> Big Projects </td>
	   <td> <?php echo($q1[0]) ?> </td>
	   <td> <?php echo(round(100*$q1[0]/($q1[0]+$q1[1]+$q1[2])) . "%") ?> </td>
	<tr>	
	<tr>
	   <td> Small Assignments </td>
	   <td> <?php echo($q1[1]) ?> </td>
	   <td> <?php echo(round(100*$q1[1]/($q1[0]+$q1[1]+$q1[2])) . "%") ?> </td>
	<tr>	
	<tr>
	   <td> Undecided </td>
	   <td> <?php echo($q1[2]) ?> </td>
	   <td> <?php echo(round(100*$q1[2]/($q1[0]+$q1[1]+$q1[2])) . "%") ?> </td>
	<tr>	
	</table>
	<br><br>
	
	Do you prefer classes online or in person? <br>
 	<br>
        <table border = "1" cellpadding = "3">
	<tr>
	   <td width = "80%"> Online </td>
	   <td> <?php echo($q1[3]) ?> </td>
	   <td> <?php echo(round(100*$q1[3]/($q1[3]+$q1[4]+$q1[5])) . "%") ?> </td>
	<tr>	
	<tr>
	   <td> In Person </td>
	   <td> <?php echo($q1[4]) ?> </td>
	   <td> <?php echo(round(100*$q1[4]/($q1[3]+$q1[4]+$q1[5])) . "%") ?> </td>
	<tr>	
	<tr>
	   <td> Undecided </td>
	   <td> <?php echo($q1[5]) ?> </td>
	   <td> <?php echo(round(100*$q1[5]/($q1[3]+$q1[4]+$q1[5])) . "%") ?> </td>
	<tr>	
	</table>
	<br><br>


	Do you prefer to start classes before or after 10am? <br>
 	<br>
        <table border = "1" cellpadding = "3">
	<tr>
	   <td width = 80%> Before </td>
	   <td> <?php echo($q1[6]) ?> </td>
	   <td> <?php echo(round(100*$q1[6]/($q1[6]+$q1[7]+$q1[8])) . "%") ?> </td>
	<tr>	
	<tr>
	   <td> After </td>
	   <td> <?php echo($q1[7]) ?> </td>
	   <td> <?php echo(round(100*$q1[7]/($q1[6]+$q1[7]+$q1[8])) . "%") ?> </td>
	<tr>	
	<tr>
	   <td> Undecided </td>
	   <td> <?php echo($q1[8]) ?> </td>
	   <td> <?php echo(round(100*$q1[8]/($q1[6]+$q1[7]+$q1[8])) . "%") ?> </td>
	<tr>	
	</table>
	<br><br>

	
	Do you prefer to have a lot of classes on three days of the week or to have a few classes per day five days a week? <br>
 	<br>
        <table border = "1" cellpadding = "3">
	<tr>
	   <td width = 80%> Three Days </td>
	   <td> <?php echo($q1[9]) ?> </td>
	   <td> <?php echo(round(100*$q1[9]/($q1[9]+$q1[10]+$q1[11])) . "%") ?> </td>
	<tr>	
	<tr>
	   <td> Five Days </td>
	   <td> <?php echo($q1[10]) ?> </td>
	   <td> <?php echo(round(100*$q1[10]/($q1[9]+$q1[10]+$q1[11])) . "%") ?> </td>
	<tr>	
	<tr>
	   <td> Undecided </td>
	   <td> <?php echo($q1[11]) ?> </td>
	   <td> <?php echo(round(100*$q1[11]/($q1[9]+$q1[10]+$q1[11])) . "%") ?> </td>
	<tr>	
	</table>
	<br><br>
</body>
</html>