<?php
require_once "config.php";

$sql = "DELETE FROM  _code";
$result = mysqli_query($conn, $sql);
$conn->close();

echo 1;

?>