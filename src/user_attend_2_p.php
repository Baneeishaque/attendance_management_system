<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>Take Attendance</title>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
        <style media="all" type="text/css">@import "../css/all.css";</style>
    </head>
    <body>
        <?php
        
        include 'dbconfig.php';
        
            echo '
<div id="main">
<div id="header">
<a href="../index.html" class="logo"><img src="../img/logos.gif" width="501" height="50" alt=""/></a>
<ul id="top-navigation">
<li><span><span><a href="user_das.php">Options</a></span></span></li>
<li class="active"><span><span><a href="user_attend_p.php">Take Attendance</a></span></span></li>
<li><span><span><a href="user_view_p.php">View Attendance</a></span></span></li>
<li><span><span><a href="../index.php">Logout</a></span></span></li>
</ul>
</div>
<div id="middle">
<div id="left-column">

</div>
<div id="center-column">
<table class="listing form" cellpadding="0" cellspacing="0">
<tr>
	<th class="full">SEARCH RESULT</th>
</th>
<tr>
	<th class="full">Register No</th>
	<th class="full">Name </th>
	<th class="full">Pre/Absc </th>
</tr>';
            $id = "";
            $conn = new mysqli($host, $username, $password, $dbname);
            $branch = $_POST['branch'];
            $semester = $_POST['semester'];
            $peroid = $_POST['period'];
            $date = date("d/m/Y");

            //echo $peroid.$branch.$semester;

            $sql = "SELECT status FROM attendance_p where branch='$branch' AND sem='$semester' AND date='$date'";

            //echo $sql;
            
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $sta = $row["status"];
                
                //echo $sta;

                if (substr_count($sta, $peroid) != 0) {
                    echo "Ateendance already taken";
                } else {
                    $sql = "SELECT `rno`, `name`, `branch`, `semester` FROM `student` WHERE `branch`='$branch' AND `semester`='$semester'";
                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                        // output data of each row
                        $i = 0;

                        while ($row = $result->fetch_assoc()) {

                            $id = $id . "-" . $row["rno"];
                        }
                        $id = $id . "-";
                        //echo $id; 
                        $i = 0;
                        $sql = "SELECT `rno`, `name`, `branch`, `semester` FROM `student` WHERE `branch`='$branch' AND `semester`='$semester'";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {


                            echo '
                    <form action="user_attend_2_action_p.php?id=' . $id;
                            echo'&rows=' . $result->num_rows;
                            echo'&peroid=' . $peroid;
                            echo' " method="POST" method="POST">
            <tr>
                    <td>' . $row["rno"];
                            echo '</td>
                    <td>' . $row["name"];
                            echo '</td>
                    <td><input type="checkbox" name="atten' . $i++;
                            echo '" value="PRE" checked></td>
            </tr>';
                        }
                    } else {
                        echo "No Data ";
                    }echo '
            <tr>
                    <td></td>
                    <td></td>

                    <td><input type="submit" value="SUBMIT"></td>
            </tr>
            </table>

            </body>

            </html>';
                }
            } else {
                $sql = "SELECT `rno`, `name`, `branch`, `semester` FROM `student` WHERE `branch`='$branch' AND `semester`='$semester'";
                $result = $conn->query($sql);


                if ($result->num_rows > 0) {
                    // output data of each row
                    $i = 0;

                    while ($row = $result->fetch_assoc()) {

                        $id = $id . "-" . $row["rno"];
                    }
                    $id = $id . "-";
                    //echo $id; 
                    $i = 0;
                    $sql = "SELECT `rno`, `name`, `branch`, `semester` FROM `student` WHERE `branch`='$branch' AND `semester`='$semester'";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {


                        echo '
                    <form action="user_attend_2_action_p.php?id=' . $id;
                        echo'&rows=' . $result->num_rows;
                         echo'&peroid=' . $peroid;
                        echo' " method="POST" method="POST">
            <tr>
                    <td>' . $row["rno"];
                        echo '</td>
                    <td>' . $row["name"];
                        echo '</td>
                    <td><input type="checkbox" name="atten' . $i++;
                        echo '" value="PRE" checked></td>
            </tr>';
                    }
                } else {
                    echo "No Data ";
                }echo '
            <tr>
                    <td></td>
                    <td></td>

                    <td><input type="submit" value="SUBMIT"></td>
            </tr>
            </table>

            </body>

            </html>';
            }
        
        ?>
