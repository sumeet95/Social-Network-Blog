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

$unsafe_variable = $_POST["title"];
$safe_variable = mysql_real_escape_string($unsafe_variable);

$unsafe_post = $_POST["post"];
$safe_post = mysql_real_escape_string($unsafe_post);
$sql = "INSERT INTO `user_post` (`post_header` , `post` , `user_id` , `date`, `likes`) VALUES ('".$safe_variable."','".$safe_post."','".$_SESSION["ID"]."','".date("Y-m-d")."','0')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

</div>

</body>
</html>