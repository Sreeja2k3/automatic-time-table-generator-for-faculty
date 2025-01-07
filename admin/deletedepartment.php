<?php 
include('../config.php');
$departmentid=$_REQUEST['department_id'];
if(isset($_REQUEST['department_id']))
{

mysqli_query($con,"delete from department where teacher_id='$departmentid'");


header('location:admindashboard.php?info=department');
}
?>