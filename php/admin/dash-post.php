<?php
session_start();
include "../db_connect.php";
//||||||||||||||||||||||||||||||||||||||||||||||||||||||
//|||||| Henter og validerer data fra index.php ||||||||
//||||||||||||||||||||||||||||||||||||||||||||||||||||||
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ticket_id']) && isset($_POST['status'])) {
    $ticketId = $_POST['ticket_id'];
    $status = $_POST['status'];
    
    if (empty($ticketId)) {
        header("Location: dash.php?error=ticketid is required!");
        exit();
    } else if (empty($status)) {
        header("Location: dash.php?error=status is required!");
        exit();
    }

    $sql = "UPDATE Tickets SET Status='$status' WHERE TicketID='$ticketId'";

    if ($conn->query($sql) === TRUE) {
        echo "Status updated.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM Brukere WHERE idBrukere = ? AND Perms = '1'";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) == 0) {
        header("Location: ../index.php");
        exit();
    }
    mysqli_free_result($result);
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($conn);
}
