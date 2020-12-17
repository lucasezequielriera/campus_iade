<?php
require "./templates/header.php";
$course = $_SESSION['course_name_exam'];
$courseId = $_SESSION['courseId'];
$userId = $_SESSION['user']['id'];
require "./cursos/". $course . "/exams/exam.php"
?>


<?php
include "./templates/footer.php";
?>