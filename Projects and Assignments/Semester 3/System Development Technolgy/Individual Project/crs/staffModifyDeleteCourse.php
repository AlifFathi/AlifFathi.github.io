<?php
include('staffSession.php');
include('dbconnect.php');

if (isset($_GET['c_code'])) {
    $course_code = $_GET['c_code'];

    $sql = "DELETE FROM tb_course WHERE c_code = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $course_code);
    $stmt->execute();
    echo "<script>alert('Course successful deleted!'); window.location.href = 'staffModifyCourse.php';</script>";
} else {
    $_SESSION['error_message'] = "No course code provided.";
}
