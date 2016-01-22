<html>
    <body>

        <p> Welcome <?php echo $_POST["name"]; ?> </p>
        <p>Your email address is: <a href="mailto:someone@example.com?Subject=Hello%20again" target="_top"><?php echo $_POST["email"]; ?></a> </p>
        <p>Your Major: <br> <?php echo $_POST["major"]; ?> </p>
        <p> You have visited: <br> <?php
        if (!empty($_POST['places'])) {
// Loop to store and display values of individual checked checkbox.
            foreach ($_POST['places'] as $selected) {
        echo $selected . "</br>";}}
        ?> </p>
        <p>Your Comments:</p> <?php echo $_POST["comment"]; ?>

    </body>
</html>
