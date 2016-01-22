<html>
<body>


<p>Testing </p>

<?php if(isset($_POST['submit'])){ 
$to = "email@example.com"; // this is your Email address 
$from = $_POST['email']; // this is the sender's Email address 
$name = $_POST['name']; 
$comment = $_POST['comments'];

echo $name;
?>


</body>
</html>