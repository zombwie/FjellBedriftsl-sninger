<?php
session_start();
include "db_connect.php";
//||||||||||||||||||||||||||||||||||||||||||||||||||||||
//|||||| Henter og validerer data fra index.php ||||||||
//||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($username)) {
        header("Location: index.php?error=username is required!");
        exit();
    } else if (empty($password)) {
        header("Location: index.php?error=password is required!");
        exit();
    }

//||||||||||||||||||||||||||||||||||||||||||||||||||||
//|||||| Sjekker login detaljer med databasen ||||||||
//||||||||||||||||||||||||||||||||||||||||||||||||||||

    $sql = "SELECT * FROM Brukere WHERE Username='$username' AND Pass='$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['Username'] === $username && $row['Pass'] === $password) {
            echo "Innlogget";
            $_SESSION['username'] = $row['Username'];
            $_SESSION['id'] = $row['idBrukere'];
            header("Location: tickets.php");
            exit();
        } else {
            header("Location: index.php?error=Ugyldig username eller password!");
            exit();
        }
    } else {
        header("Location: index.php?error=Jeg forstår ikke hva som skjer!");
        exit();
    }
}
