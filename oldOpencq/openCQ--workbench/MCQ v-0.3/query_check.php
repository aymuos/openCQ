<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "id12989433_newmcq";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM exam_mark WHERE student_id = 'jarvis' and exam_question_id = 25";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["student_id"]. " - Name: " . $row["mark"]. " ";
    }
} else {
    echo "0 results";
}
$conn->close();
?>