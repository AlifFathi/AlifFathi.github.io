<?php
include('staffSession.php');
include('dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $r_tid = $_POST['r_tid'];
    $new_course = $_POST['r_course'];
    $new_status = $_POST['r_status'];

    $fetch_sql = "SELECT r_course, r_status, r_student FROM tb_registration WHERE r_tid = ?";
    $fetch_stmt = $con->prepare($fetch_sql);
    $fetch_stmt->bind_param("s", $r_tid);
    $fetch_stmt->execute();
    $fetch_stmt->bind_result($old_course, $old_status, $student);
    $fetch_stmt->fetch();
    $fetch_stmt->close();

    if ($old_course != $new_course) {
        $check_sql = "SELECT * FROM tb_registration WHERE r_course = ? AND r_student = ?";
        $check_stmt = $con->prepare($check_sql);
        $check_stmt->bind_param("ss", $new_course, $student);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            echo "<script>alert('Student is already registered for this course.'); window.location.href = 'staffAmendRegistration.php';</script>";
            exit;
        }
        $check_stmt->close();

        $check_capacity_sql = "SELECT c_current_student, c_max_student FROM tb_course WHERE c_code = ?";
        $check_capacity_stmt = $con->prepare($check_capacity_sql);
        $check_capacity_stmt->bind_param("s", $new_course);
        $check_capacity_stmt->execute();
        $check_capacity_stmt->bind_result($current_students, $max_students);
        $check_capacity_stmt->fetch();
        $check_capacity_stmt->close();

        if ($current_students >= $max_students) {
            echo "<script>alert('The new course is full.'); window.location.href = 'staffAmendRegistration.php';</script>";
            exit;
        }
    }

    $update_sql = "UPDATE tb_registration SET r_course = ?, r_status = ? WHERE r_tid = ?";
    $update_stmt = $con->prepare($update_sql);
    $update_stmt->bind_param("sss", $new_course, $new_status, $r_tid);

    if ($update_stmt->execute()) {

        if ($old_course != $new_course) {
            if ($old_status == 2) {
                $decrement_sql = "UPDATE tb_course SET c_current_student = c_current_student - 1 WHERE c_code = ?";
                $decrement_stmt = $con->prepare($decrement_sql);
                $decrement_stmt->bind_param("s", $old_course);
                $decrement_stmt->execute();
                $decrement_stmt->close();
            }
            if ($new_status == 2) {
                $increment_sql = "UPDATE tb_course SET c_current_student = c_current_student + 1 WHERE c_code = ?";
                $increment_stmt = $con->prepare($increment_sql);
                $increment_stmt->bind_param("s", $new_course);
                $increment_stmt->execute();
                $increment_stmt->close();
            }
        }
        echo "<script>alert('Registration updated successfully.'); window.location.href = 'staffAmendRegistration.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error updating registration.'); window.location.href = 'staffAmendRegistration.php';</script>";
        exit;
    }
}
