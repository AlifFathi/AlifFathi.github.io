<?php
include('staffSession.php');
include('dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_code = strtoupper(($_POST['course_code']));
    $course_name = $_POST['course_name'];
    $max_student = $_POST['max_student'];
    $credit_hour = $_POST['credit_hour'];
    $lecturer_id = $_POST['lecturer_id'];

        // Check if course code already exists
        $sql_check = "SELECT * FROM tb_course WHERE c_code = ?";
        $stmt = $con->prepare($sql_check);
        $stmt->bind_param('s', $course_code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('Courses already exists!'); window.location.href = 'staffAddNewCourse.php';</script>";
        } else {
            // Insert new course
            $sql_insert = "INSERT INTO tb_course (c_code, c_name, c_credit, c_max_student, c_lec) VALUES (?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql_insert);
            $stmt->bind_param('ssiis', $course_code, $course_name, $credit_hour, $max_student, $lecturer_id);
            $stmt->execute();
        }

}

echo "<script>alert('Courses Added successfully!'); window.location.href = 'staffAddNewCourse.php';</script>";
