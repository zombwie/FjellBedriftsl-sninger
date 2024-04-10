<?php
include "tickets-post.php";
if ((!isset($_SESSION['id'])) || (!isset($_SESSION['username']))) {
    header("Location: index.php");
    exit();
} else {

?>
    <!DOCTYPE html>
    <html>
    <link rel="stylesheet" type="text/css" href="style.css">
    <head>
    </head>

    <body>
        <div>
            <h1>Submit a ticket</h1>
            <form action="tickets-post.php" method="post">
                <h2>Login:</h2>
                <label>Tittel: </label>
                <input type="text" name="Title" placeholder="Tittle"><br />
                <label>text: </label>
                <input type="text" name="Text" placeholder="Text"><br />
                <input type="color" name="Farge" placeholder="Farge"><br />
                <button type="submit">Submit</button><br />
            </form>
        </div>
        <div>
            <h1>My tickets</h1>
            <?php
            $sql = "SELECT * FROM Tickets WHERE UserID='" . $_SESSION['id'] . "'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr><th>Title</th><th>Text</th><th>Status</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['Title'] . "</td>";
                    echo "<td>" . $row['Inhold'] . "</td>";
                    echo "<td>" . $row['Status'] . "</td>";
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

    </html>
<?php
}
?>