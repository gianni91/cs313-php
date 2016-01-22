<html>
<body>


<p>Testing </p>

Name: <?php echo $_POST['name']; ?> <br>
E-mail: <?php echo $_POST['email']; ?> <br>
Major: <?php echo $_POST["major"]; ?> <br>
Places Visited:
<?php
if (isset($_POST['submit'])) {
if(!empty($_POST['places'])) {
echo "<span>You have selected :</span><br/>";
// As output of $_POST['places'] is an array we have to use Foreach Loop to display individual value
foreach ($_POST['places'] as $select)
{
echo "<span><b>".$select."</b></span><br/>";
}
}
else { echo "<span>Please Select Atleast One Color.</span><br/>";}
}
?>

Comments: <?php echo $_POST["comments"]; ?> <br>


</body>
</html>