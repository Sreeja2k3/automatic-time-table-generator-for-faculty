<?php
include('../config.php');

if (isset($_GET['subject_id'])) {
    $subject_id = $_GET['subject_id'];

    // Delete query
    $deleteQuery = "DELETE FROM semester WHERE sem_id = '$subject_id'";
    
    if (mysqli_query($con, $deleteQuery)) {
        // Redirect to admin dashboard with a success message
        header('Location: admindashboard.php?info=semester_list&status=deleted');
    } else {
        // Redirect with an error message
        header('Location: admindashboard.php?info=semester_list&status=error');
    }
}
?>
