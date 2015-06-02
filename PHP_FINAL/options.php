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
	<li><a href="adminIndex.php"> Home </a></li>
	<li><a href="list.php"> Browse Latest Threads </a></li>
	<?
	echo "<li><a href=profile.php?f_id=".$_SESSION['ID']."> My Profile </a></li>";
	?>
	<li><a href="options.php"> Admin Options </a></li>
	<li><a href="logout.php">Logout</a></li>
</ul>
</div>


<div id="trending">
<h3> All Users By ID Order </h3>
<table>
<?
$sql = "SELECT ID, fname, lname FROM user_login";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$count++;
		echo "<tr>";
			echo "<td><h4>".$row["ID"]." ".$row["fname"]." ".$row["lname"]."</h4></td>";
		echo "</tr>";

    }
}

?>
</table>
</div>

<div id="delete">
<h3> Delete User by ID </h3>
<form method="post" action="delete.php">
Delete User: <br><input type="text" size="20" maxlength="30" name="id">:<br />
<br><input type="submit" value="submit" name="submit"><br />
</form>


</div>
</body>
</html>