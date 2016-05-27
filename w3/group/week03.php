<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Week 03</title>
    </head>
    <body>
        <?php
        $majors = array(
            "CS" => "Computer Science",
            "WebDev" => "Web Development and Design",
            "CIT" => "Computer Information Technology",
            "CompE" => "Computer Engineering"
        );

        $name = filter_input(INPUT_POST, "name");

        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            echo "<p>Name: Only letters and white space allowed </p>";
        } else {
            echo "<p>Name: " . $name . "</p>";
        }
        
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        
        if ($email == NULL || $email == "") {
            echo "<p>E-mail: Please enter a valid e-mail address </p>";
        }
        else {
                   echo "<p>E-mail: <a href='mailto:" . filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL) . "' target='_top'>" . filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL) . "</a></p>";
        }

        $major = filter_input(INPUT_POST, "major");

        if ($major != NULL || "") {
            echo "<p>Major: " . $majors[filter_input(INPUT_POST, "major")] . "</p>";
        }

        if (isset($_POST["place"])) {
            echo "<p>These are the places you have visited:<br>";
            if (is_array($_POST["place"])) {
                foreach ($_POST["place"] as $places) {
                    echo "&emsp;" . $places . "<br>";
                }
            } else
                echo "&emsp;" . $_POST["place"] . "<br>";
            echo "</p>";
        }

        $comment = filter_input(INPUT_POST, "comment");

        if ($comment != NULL || $comment != "") {
            echo "<p>Comments:<br>";
            echo filter_input(INPUT_POST, "comment") . "<br>";
            echo "</p>";
        }
        ?>
    </body>
