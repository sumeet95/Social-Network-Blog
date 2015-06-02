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
<div id="adminNav">
<h1 id="title"> Sumeets Sports Blog </h1>
<ul>
	<li><a href="index.php"> Home </a></li>
	<li><a href="list.php"> Browse Latest Threads </a></li>
	<?
	echo "<li><a href=profile.php?f_id=".$_SESSION['ID']."> My Profile </a></li>";
	?>
	<li><a href="options.php"> Admin Options </a></li>
	<li><a href="logout.php">Logout</a></li>
</ul>
</div>

<div id="content">

<div id="friends">

<form method="post" action="add.php">
Add: <br><input type="text" size="20" maxlength="30" name="add"> 
		 <input type="submit" value="Add" name="submit"><br/>
</form>


<h2>  You are Following : <h2>

<?

$sql = "SELECT fname, friend_id FROM friend WHERE user_id = ".$_SESSION["ID"];
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		echo "<tr>";
			echo '<a href="profile.php?f_id='.$row["friend_id"].'">'.$row["fname"].'</a></br>';
		echo "</td>";
	}
}
?>

</div>

<div id="trending">
<h3> Trending Topics </h3>
<table>
<?
$sql = "SELECT post_id,post, post_header, date, fname, likes FROM user_post, user_login WHERE (user_post.user_id = user_login.ID) ORDER BY likes DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
	$count = 0;
    while($row = mysqli_fetch_assoc($result) and $count < 3) {
		$count++;
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

<div id="frmPost">
<h3> Make a Post </h3>
<form method="post" action="submit.php">
Title: <br><input type="text" size="20" maxlength="30" name="title">:<br />
Post: <br><textarea rows="8" cols="50" name="post" wrap="physical">Enter your post</textarea>:<br />
<br><input type="submit" value="submit" name="submit"><br />
</form>

</div>

</div>

<div style="clear: both;" id="footer">
</div>

</div>
</body>
</html>