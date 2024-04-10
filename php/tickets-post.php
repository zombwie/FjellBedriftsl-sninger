<?php
session_start();
include "db_connect.php";
//||||||||||||||||||||||||||||||||||||||||||||||||||||||
//|||||| Henter og validerer data fra index.php ||||||||
//||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (isset($_POST['Title']) && isset($_POST['Text']) && isset($_POST['Farge']) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    $Title = validate($_POST['Title']);
    $Text = validate($_POST['Text']);
    $Farge = validate($_POST['Farge']);

    if (empty($Title)) {
        header("Location: index.php?error=Title is required!");
        exit();
    } else if (empty($Text)) {
        header("Location: index.php?error=Text is required!");
        exit();
    }

//||||||||||||||||||||||||||||||||||||||||||||||||||||
//|||||| Sjekker login detaljer med databasen ||||||||
//||||||||||||||||||||||||||||||||||||||||||||||||||||

    $sql = "Insert into Tickets (Title, Inhold, UserID, Farge) VALUES ('$Title', '$Text', '".$_SESSION['id']."', '$Farge')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Ticket submitted";
        header("Location: tickets.php");
        exit();
    } else {
        header("Location: tickets.php?error=Something went wrong!");
        exit();
    }
}
