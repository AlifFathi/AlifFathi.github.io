<?php
include('staffSession.php');
include('dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $original_c_code = $_POST['original_c_code'];
    $c_code = $_POST['c_code'];
    $c_name = $_POST['c_name'];
    $c_credit = $_POST['c_credit'];
    $c_max_student = $_POST['c_max_student'];
    $c_lecturer_id = $_POST['c_lecturer_id'];

    $sql = "UPDATE tb_course SET c_code = ?, c_name = ?, c_credit = ?, c_max_student = ?, c_lec = ? 
            WHERE c_code = ?";

    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ssiiss", $c_code, $c_name, $c_credit, $c_max_student, $c_lecturer_id, $original_c_code);


    if (mysqli_stmt_execute($stmt)) {

        echo "<script>alert('Course updated successfully!'); window.location.href = 'staffModifyCourse.php';</script>";
    } else {

        echo "<script>alert('An error occurred while updating the course. Please try again.'); window.location.href = 'staffModifyCourse.php';</script>";
    }


    mysqli_stmt_close($stmt);
}

mysqli_close($con);
?>