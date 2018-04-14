<?php
$servername = "academic-mysql.cc.gatech.edu";
$username = "cs4400_team_70";
$password = "aPYkFHqx";
$dbname = "cs4400_team_70";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM User where Username=\"" . $_POST["username"] . "\" and Password=\"" . md5($_POST["password"]) . "\"";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo "Username: " . $row["Username"]. " - Email: " . $row["Email"]. "<br>";
        header("Location: http://google.com");
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
