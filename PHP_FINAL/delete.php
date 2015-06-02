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


</head>

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

$sql = "DELETE FROM `user_login` WHERE ID='".$_POST["id"]."'";

if (mysqli_query($conn, $sql)) {
    echo "User has been deleted";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

</div>

</body>
</html>