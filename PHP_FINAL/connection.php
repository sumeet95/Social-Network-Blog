<?
class Connect{

function __construct()
    {
		$servername = "localhost";
		$username = "ttls0034";
		$password = "823270798";
		$dbname = "ttls0034_a";
		
		// Create connection
		$this->conn = new mysqli($servername, $username, $password, $dbname);
    }

function &getConnection()
{
   return $this->conn;
}

}

?>