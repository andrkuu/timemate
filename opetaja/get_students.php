<?php
session_start();
$subject_id = $_POST["subject_id"];
include("functions_teacher.php");

echo getStudents($subject_id);

