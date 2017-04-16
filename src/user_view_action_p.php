<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

    <head>
        <title>View Attendance</title>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
        <style media="all" type="text/css">@import "../css/all.css";</style>
    </head>
    <body>
        <?php
     
        include 'dbconfig.php';
      $date = $_POST['date'];
$branch = $_POST['branch'];
$semester = $_POST['semester'];

            // output data of each row

            echo '
		
<div id="main">
<div id="header">
    <a href="../index.html" class="logo"><img src="../img/logos.gif" width="501" height="50" alt=""/></a>
<ul id="top-navigation">
<li><span><span><a href="user_das.php">Options</a></span></span></li>
<li><span><span><a href="user_attend_p.php">Take Attendance</a></span></span></li>
<li class="active"><span><span><a href="user_view_p.php">View Attendance</a></span></span></li>
<li><span><span><a href="../index.php">Logout</a></span></span></li>
</ul>
</div>
<div id="middle">
<div id="left-column">

</div>
<div id="center-column">
<table class="listing form" cellpadding="0" cellspacing="0">

<tr>
	<th class="full">Date :</th>
	<th class="full">'.$date.'</th>
	
</tr>

<tr>
	
	<th class="full">Branch : </th>
        <th class="full">'.$branch.'</th>
        <th class="full">Semester : </th>
        <th class="full">'.$semester.'</th>

</tr>';




$conn = new mysqli($host, $username, $password, $dbname);


$sql = "SELECT `attendance_p`.`date`FROM `attendance_p` WHERE `attendance_p`.`date`='$date' AND `attendance_p`.`branch`='$branch' AND `attendance_p`.`sem`='$semester' ";
//echo $sql;
$result = $conn->query($sql);  
if ($result->num_rows > 0) {
	
	

echo '<tr>
	<th class="full">Register No</th>
	<th class="full">Name </th>
	<th class="full">P1 </th>
        <th class="full">P2 </th>
        <th class="full">P3 </th>
        <th class="full">P4 </th>
        <th class="full">P5 </th>
</tr>';
	$sql = "SELECT `rno` FROM `student` WHERE `branch`='$branch' AND `semester`='$semester'";
	//echo $sql;
	$result2 = $conn->query($sql);
	while ($row2 = $result2->fetch_assoc()) {
		$r=$row2["rno"];
		$sql = "SELECT `student`.`name`,`attendance_p`.`date`, `attendance_p`.`rno`, `attendance_p`.`p1`,`attendance_p`.`p2`,`attendance_p`.`p3`,`attendance_p`.`p4`,`attendance_p`.`p5`,`p` FROM `attendance_p`,`student` WHERE `attendance_p`.`date`='$date' AND `attendance_p`.`branch`='$branch' AND `attendance_p`.`sem`='$semester' AND `student`.`rno`=`attendance_p`.`rno` AND `attendance_p`.`rno`=$r";
	//echo $sql;
	$result = $conn->query($sql);  

	$p1='-';
	$p2='-';
	$p3='-';
	$p4='-';
	$p5='-';
	
	
	
	while ($row = $result->fetch_assoc()) {
	$rno=$row["rno"];
	$name=$row["name"];
	$p = $row["p"];
	
	if (substr_count($p, 'p1') != 0)
		{
			$p1=$row["p1"];
			continue;
		}
	
	
	
	if (substr_count($p, 'p2') != 0)
		{
			$p2=$row["p2"];
			continue;
		}
	
	
	if (substr_count($p, 'p3') != 0)
		{
			$p3=$row["p3"];
			continue;
		}
	
	
	if (substr_count($p, 'p4') != 0)
		{
			$p4=$row["p4"];
			continue;
		}
	
	
	if (substr_count($p, 'p5') != 0)
		{
			$p5=$row["p5"];
			continue;
		}
	
	
	
	

	
	
	}
	echo '<tr>';
	
	if($result->num_rows!=0)
	{
		echo'<td>'.$rno.'</td>
		<td>'.$name.'</td>';
	}
	else
	{
		$rno++;
		echo'<td>'.$rno.'</td>';
		$sql = "SELECT `name` FROM `student` WHERE `rno`=$rno";
		//echo $sql;
		$result2 = $conn->query($sql); 
		$row2 = $result2->fetch_assoc();
		$name=$row2["name"];
		echo '<td>'.$name.'</td>';
	}
	
	echo'<td>'.$p1.'</td>';
	echo'<td>'.$p2.'</td>';
	echo'<td>'.$p3.'</td>';
	echo'<td>'.$p4.'</td>';
	echo'<td>'.$p5.'</td>';
	echo'</tr>';
	}
	
	

	
	
}
else {
                echo "No Data ";
            }
        
        ?>	
        </table>

    </body>

</html>


