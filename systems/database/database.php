<?php
$hostname     = "localhost";
$databasename = "db_banchaidienchautam";
$username     = "root";
$password     = "123456";

$conn = mysqli_connect($hostname, $username, $password, $databasename);
// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
mysqli_query($conn,"set names 'utf8'");
/*$conn = @mysqli_connect($hostname, $username, $password) or
die("Không thể kết nối cơ sở dữ liệu !");
mysqli_select_db($databasename);
mysqli_query("set names 'utf8'");*/
?>