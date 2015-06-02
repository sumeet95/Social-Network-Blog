<html>
<body>
<head>

<?
session_start();
include 'connection.php';
$connect = new Connect();
$conn = &$connect->getConnection();

if(!isset($_SESSION['ID'])){
   header("Location:login.html");
}

?>

<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<div id="container">
<div id="nav">
<h1 id="title"> Sumeets Sports Blog </h1>
<ul>
	<li><a href="index.php"> Home </a></li>
	<li><a href="list.php"> Browse Latest Threads </a></li>
	<?
	echo "<li><a href=profile.php?f_id=".$_SESSION['ID']."> My Profile </a></li>";
	?>
	<li><a href="logout.php">Logout</a></li>
</ul>
</div>
<?

$sql = "Select ID , fname, lname from user_login where fname = '".$_POST['add']."'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
        $f_id= $row["ID"];
		$sql = "INSERT INTO `friend` (`friend_id` , `user_id` , `fname` , `lname`) VALUES ('".$f_id."','".$_SESSION['ID']."','".$row['fname']."','".$row['lname']."')";
		if(mysqli_query($conn, $sql)){
			echo "Added";
		} else {
			echo "User Does not Exist. The name is case sensitive";
			echo $_SESSION['ID'];
			echo $f_id;
		}
	}
} else {
	mysqli_close($conn);
	echo "User Does not exist";
}

?>

</div>

</body>
</html>