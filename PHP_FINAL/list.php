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

<div id="trending">
<h3> All Posts </h3>
<table>
<?
$sql = "SELECT post_id, post_header, post, date, fname, likes FROM user_post, user_login WHERE (user_post.user_id = user_login.ID) ORDER BY post_id DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
	$count = 0;
    while($row = mysqli_fetch_assoc($result)) {
		echo "<tr>";
			echo '<td><h4><a href="post.php?p_id='.$row["post_id"].'">'.$row["post_header"].'</a></h4></td>';
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>".$row["post"]."</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>".$row["date"]." By ".$row["fname"]." Likes: ".$row["likes"]."</td>";
        echo "</tr>";
		
		echo "<tr>";
		echo "<td></td>";
		echo "<td></td>";
		echo "</tr>";
    }
}
?>
</table>
</div>


</div>
</div>
</body>
</html>