<?php
require("../../../config.php");
session_start();

$id = $_POST["id"];

$result = null;
$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
$stmt = $conn -> prepare("DELETE FROM time_reportings WHERE id IN (?)");

$stmt->bind_param("i", $id);

$stmt -> execute();
echo $conn -> error;
$stmt->close();
$conn->close();

