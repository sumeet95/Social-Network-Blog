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

<div id="fullpost">
<table>




<?
$p_id = intval($_GET['p_id']);
$_SESSION['p_id'] = $p_id;
$sql = "SELECT post_id, post_header, post, date, fname, likes FROM user_post, user_login WHERE (user_post.user_id = user_login.ID) AND post_id =".$p_id;
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		echo "<tr>";
			echo "<td><h2>".$row["post_header"]."</h2></td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>".$row["post"]."</td>";
		echo "</tr>";
		
		echo "<tr>";
			echo "<td>".$row["date"]." By ".$row["fname"]."<br/ ><br />"."Likes: ".$row["likes"]."</td>";
        echo "</tr>";
		
    }
}

?>
</table>

<form action="<?php echo $PHP_SELF ?>" method="post" name"likeform">
  <input name="like" type="submit" id="like" value="Like Post" />
</form>

<?

if ($_POST['like'])
{

$sql = "Update `user_post` SET `likes` = likes+1 WHERE post_id =".$p_id;
mysqli_query($conn, $sql); 
    
} 

?>

</div>

<div id="makePost">
<form method="post" action="reply.php">
Reply : <br><textarea rows="3" cols="90" name="post" wrap="physical"></textarea>:<br />
<br><input type="submit" value="submit" name="submit"><br />
</form>
</div>

<div id="comments">
<?

$sql = "SELECT comment, fname FROM comment, user_login  WHERE (comment.user_id = user_login.ID) AND post_id =".$p_id;
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		echo "<h5>".$row["fname"].": </h5>";
		echo "<br/>";
		echo $row["comment"];
    }
}
?>
</div>

</div>
</body>
</html>