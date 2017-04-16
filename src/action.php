<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
<title>Public Percentage View</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
<style media="all" type="text/css">@import "../css/all.css";</style>
</head>
<body>
<div id="main">
<div id="header">
<a href="../index.html" class="logo"><img src="../img/logos.gif" width="501" height="50" alt=""/></a>
<br><br><br>
<ul id="top-navigation">
    <li><span><span><a href="../index.php">Login</a></span></span></li>
<li><span><span><a href="pub_view.php">View Attendance</a></span></span></li>
<li class="active"><span><span><a href="pub_per_view.php">View Percentage</a></span></span></li>

</ul>
</div>
<div id="middle">
<div id="left-column">

</div>
<div id="center-column">
<table class="listing form" cellpadding="0" cellspacing="0">

<?php
$b=$_POST['branch'];
	$s=$_POST['semester'];



	include 'dbconfig.php';
	$conn = new mysqli($host, $username, $password, $dbname);
	
	$select = "SELECT  `name`, `rno` FROM `student` WHERE `branch`='$b' and `semester`='$s'";
	$answer = $conn->query($select);
	
	if($answer->num_rows==0)
	{
		echo '<tr>
	
	<th class="full">Branch : '.$b.'</th>
       
        <th class="full">Semester : '.$s.'</th>
       

</tr>
<tr>
	<th class="full">No Data</th>
</tr>';
	}
	
	else
	{
		echo '<tr>
	
	<th class="full">Branch : '.$b.'</th>
       
        <th class="full">Semester : '.$s.'</th>
       

</tr>
<tr>
	<th class="full">Register No</th>
	<th class="full">Name </th>
	<th class="full">Percentage</th>
</tr>';
		$flag=0;
	while($row = $answer->fetch_assoc())
	{
		$rno=$row["rno"];
		echo '<tr>
		<td>'.$row["rno"].'</td>
	<td>'.$row["name"].'</td>';
	
	
		
		$select2 = "SELECT `date`,p1,p2,p3,p4,p5,p FROM `attendance_p` WHERE `branch`='$b' and `sem`='$s'and rno='$rno' ";
		//echo $select2;
		
		$answer2 = $conn->query($select2);
		
		if($flag==0)
		{
			$n=$answer2->num_rows;
			$flag=1;
		}
		
		
		if($answer2->num_rows==0)
		{
			echo '<td>-</td></tr>';
		}
		else
		{
			$i=0;
			
			while($row2 = $answer2->fetch_assoc())
			{
				$peroid=$row2["p"];
				//echo $row2[$peroid];
				
				if($row2[$peroid]=='PRE')
				{
					$i++;
				}
				
				
			}
			
	
			//echo $i.' ';
			//echo $n.'-';
	
			echo '<td>'.(($i/$n)*100).'%</td></tr>';
		}
		
		
		
	}
	}
	
	

?>
	

</table>
		

</body>

</html>
