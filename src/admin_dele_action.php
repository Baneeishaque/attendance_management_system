<?php 
include 'dbconfig.php';
$conn = new mysqli($host, $username, $password, $dbname);
$id = $_GET['id'];
$sql = "DELETE FROM `student` WHERE `rno`='$id'";
$result = $conn->query($sql);
//echo 'Student Information Was Deleted';
echo '<script>alert("Student Information Was Deleted")</script>';
echo '<script>window.location="admin_das.php"</script>';
?>