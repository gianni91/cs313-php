<html>
<body>


<p>Testing </p>

Name: <?php echo $_POST['name']; ?> <br>
E-mail: <?php echo $_POST['email']; ?> <br>
Major: <?php echo $_POST['major']; ?> <br>
Places Visited: 
<?php 
   foreach($_POST["places"] as $places){
     echo $places." ";
}?> <br>
Comments: <?php echo $_POST["comments"]; ?> <br>


</body>
</html>