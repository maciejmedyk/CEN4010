<?php
session_start();
include('../connection.php');
$error='';

if (isset($_POST['userType'])) {
	$username=$_POST['userName'];
    $password=$_POST['password'];
	if($_POST['userType'] == "Driver"){
        $username=$_POST['userName'];
        $password=$_POST['password'];
        $active = 1;

        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = $db->real_escape_string($username);
        $password = $db->real_escape_string($password);
		$query = "SELECT
					  *
					FROM drivers
					WHERE dPassword='$password' AND dUsername='$username' AND dActive=1";
			
		$sql = $db->query($query);
		$row = $sql->fetch_array();
        $row_cnt = $sql->num_rows;
        if ($row_cnt == 1){
            $_SESSION['loginUser']=$username;
			$_SESSION['driverID'] = $row['dID'];
			$_SESSION['driverName'] = $row['dFirstName']." ".$row['dLastName'];
			$_SESSION['userType']=$_POST['userType'];
			$error = 0;
        } else {
			// Trap will go here
            $error = "Username or Password is invalid";
        }
		echo $error;
	} else if($_POST['userType'] == "Admin"){
		$username=$_POST['userName'];
        $password=$_POST['password'];
        $active = 1;


        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = $db->real_escape_string($username);
        $password = $db->real_escape_string($password);

        $query = "select * from superusers where sPassword='$password' AND sUsername='$username' AND sActive=1";
		
		$sql = $db->query($query);
		$row = $sql->fetch_array();
        $row_cnt = $sql->num_rows;
        if ($row_cnt == 1){
            $_SESSION['loginUser']=$username;
			$_SESSION['adminID'] = $row['sID'];
			$_SESSION['adminName'] = $row['sFirstName']." ".$row['sLastName'];
			$_SESSION['userType']=$_POST['userType'];
			$error = 0;
        } else {
			// Trap will go here
            $error = "Username or Password is invalid";
        }
		echo $error;
	}
    
}
?>