<html>
<body>
<head>

<?
session_start();
include 'connection.php';
$connect = new Connect();
$conn = &$connect->getConnection();

?>


</head>

<div id="container">

<?

$unsafe_post = $_POST["post"];
$safe_post = mysql_real_escape_string($unsafe_post);
$sql = "INSERT INTO `user_login` (`username` , `password` , `fname` , `lname`, `email`) VALUES ('".$_POST["username"]."','".$_POST["password"]."','".$_POST["first"]."','".$_POST["last"]."','".$_POST["email"]."')";

if (mysqli_query($conn, $sql)) {
    echo "New Account has been created";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

</div>

</body>
</html>