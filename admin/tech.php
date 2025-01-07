<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "timetable";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$timetable_json = json_encode($weekTimeTable);
$query = "INSERT INTO  timeschedule(course_id, semester, timetable) VALUES ('$courseid', '$s', '$timetable_json')";
mysqli_query($con, $query);