<?xml version = "1.0" encoding = "utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml">


<?php
  header("Content-type: text/xml\n\n");

  print ("hi there <br />");

// Same as last porject but we are callling our own php file and still have to make a query string so that it doesn't reload the page. 
 $performanceType = $_GET['performanceType'];
 $firstName = $_GET['firstName'];
 $lastName = $_GET['lastName'];
 $studentId = $_GET['studentId'];
 $skillLevel = $_GET['skillLevel'];
 $instrument = $_GET['instrument'];
 $location = $_GET['location'];
 $roomNumber = $_GET['roomNumber'];
 $time = $_GET['time'];
 $choice = $_GET['choice'];

 $fileNm = "/home/job09001/public_html/readWrite/pianoFest.txt";

 
  if($choice == "Register")
  {
    $fileVar = fopen($fileNm,"a+"); //appends to the file
    
    $outString = $performanceType."++".$lastName.", ".$firstName.
       "++".$studentId."++".$skillLevel."++".$instrument."++".$location.
       "++".$roomNumber."++".$time."\n";



/*
//    $outString = "{ \"students\" :\n  [\n";
    $outString = "";
    $outString = $outString."\n    { \"performanceType\" : \"".
       $performanceType."\",\n      \"firstName\" : \" ".
       $firstName."\"\n    }";
    $outstring = $outstring."\n  ]\n}";
       //.$lastName." ".$studentId.
//       " ".$skillLevel." ".$instrument." ".$location." ".$roomNumber." ".
       //      $time."\n";
       */
    $fSize = fwrite($fileVar,$outString);
  }
  else
    $fileVar = fopen($fileNm,"w+"); //reWrites the file

  fclose($fileVar);

  $fileVar = fopen($fileNm,"r+"); 
  $fileStr = fread($fileVar, filesize($fileNm));
  printf ($fileStr);
  fclose($fileVar);
?>
     
     
<head>
  <link rel = "stylesheet" type = "text/css" href = "formValidSheet.css" />
  <title>Concert Registration</title>

</head>
/*
<body>
  <h1> Piano Festival Registration </h1>
<form>
  Performance Type: 
  <select id="performance_type">
    <option value="solo">Solo</option>
    <option value="duet">Duet</option>
    <option value="concierto">Concierto</option>
  </select><br />
  First Name:
  <input type="text" id="first_name"></input> <br />
  Last Name:
  <input type="text" id="last_name"></input> <br />
  Student ID:
  <input type="text" id="student_id"></input> <br />
  Skill Level:
  <select id="skill_level">
    <option value="beginner">Beginner</option>
    <option value="intermadiate">Intermediate</option>
    <option value="pre-advanced">Pre-advanced</option>
    <option value="advanced">Advanced</option>
  </select><br />
  Instrument:
  <select id="instrument">
    <option value="piano">Piano</option>
    <option value="voice">Voice</option>
    <option value="string">String</option>
    <option value="organ">Organ</option>
    <option value="other">Other</option>
  </select><br />
  Location: 
  <input type="text" id="location"></input><br />
  Room #:
  <input type="text" id="room_number"></input><br />
  Time:
  <select id="time" name="time">
    <option value="8:00am">8:00am</option>
    <option value="8:15am">8:15am</option>
    <option value="8:30am">8:30am</option>
    <option value="8:45am">8:45am</option>
    <option value="9:00am">9:00am</option>
    <option value="9:15am">9:15am</option>
    <option value="9:30am">9:30am</option>
    <option value="9:45am">9:45am</option>
    <option value="10:00am">10:00am</option>
    <option value="10:15am">10:15am</option>
    <option value="10:30am">10:30am</option>
    <option value="10:45am">10:45am</option>
  </select><br />


</form>
*/

<!--
     /*
  <p align="center">
    Start <br />
    City:
    <input type="text" id="startCity"/> <br />
    State:
    <input type="text" id="startState" maxlength="2" /> <br /><br />
    Destiation <br />
    City:
    <input type="text" id="endCity" /> <br />
    State:
    <input type="text" id="endState" maxlength="2"/> <br />
    <br />
    <span id="distance" align="center" ></span> <br />
    <span id="mode" align="center" ></span>

    <br />
    <br />
    <button id="button" onclick="loadText()" > Calculate Distance  </button>

  </p>
     */
-->

</body>
</html>
