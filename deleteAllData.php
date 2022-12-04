<?php
require_once "config.php";

$sql = "DELETE FROM  donation";
$result = mysqli_query($conn, $sql);
$conn->close();

echo 1;

?>