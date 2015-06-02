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
$sql = "INSERT INTO `comment` (`post_id` , `user_id` , `time`, `comment`) VALUES ('".$_SESSION['p_id']."','".$_SESSION["ID"]."','".date("Y-m-d")."','".$_POST["post"]."')";

if (mysqli_query($conn, $sql)) {
    echo "<p>Reply Successful</p>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>


</div>
</div>
</body>
</html>