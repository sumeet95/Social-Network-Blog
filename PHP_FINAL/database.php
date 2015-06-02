<?php


//get the username and the password from the form
$login = $_POST["username"];
$login_password = $_POST["password"];

		$servername = "localhost";
		$username = "ttls0034";
		$password = "823270798";
		$dbname = "ttls0034_a";
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);


$sql = "SELECT ID FROM user_login WHERE username = '".$login."'"." AND "."password = '".$login_password."'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row["ID"];
    }
	
	session_start();
	$_SESSION['ID'] =  $id; 
	if($id == 1){
		include 'adminIndex.php';
	}else{
		include 'index.php';
	}
	
} else {
    include 'login.html';
	mysqli_close($conn);
}

?>
