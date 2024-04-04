<?php

// Process register form

include 'db_connect.php';

// Validate user input and insert into database
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);


    if (empty($username)) {
        header("Location: register.php?error=Username is required!");
        exit();
    } else if (empty($password)) {
        header("Location: register.php?error=Password is required!");
        exit();
    }

    $sql = "INSERT INTO Brukere (Username, Pass) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
