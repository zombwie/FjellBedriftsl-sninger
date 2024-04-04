<?php
include "dash-post.php";
if ((!isset($_SESSION['id'])) || (!isset($_SESSION['username']))) {
    header("Location: index.php");
    exit();
} else {
?>
    <!DOCTYPE html>
    <html>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <head>
    </head>

    <body>
        <div>
            <h1>Alle tickets</h1>
            <?php
            $sql = "SELECT * FROM Tickets";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr><th>Title</th><th>Text</th><th>Status</th><th>UserID</th><</tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['Title'] . "</td>";
                    echo "<td>" . $row['Inhold'] . "</td>";
                    echo "<td><form action='dash-post.php' method='post'><select name='status_" . $row['TicketID'] . "' onchange='updateStatus(" . $row['TicketID'] . ")'><option value=''></option><option value='solved'>Solved</option><option value='worked on'>Worked On</option></select><input type='hidden' name='ticket_id' value='" . $row['TicketID'] . "'></form></td>";
                    echo "<td>" . $row['UserID'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No tickets found.";
            }
            ?>
        </div>
        <footer></footer>
    </body>
    <script>
        function updateStatus(ticketId) {
            var status = document.querySelector(`select[name='status_${ticketId}']`).value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "dash-post.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    console.log("Status updated.");
                }
            }
            xhr.send("ticket_id=" + ticketId + "&status=" + status);
        }
    </script>

    </html>
<?php
}
?>
