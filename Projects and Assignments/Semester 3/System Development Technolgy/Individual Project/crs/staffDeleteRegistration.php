<?php
include('staffSession.php');
include('dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['r_tid'])) {
    $r_tid = $_POST['r_tid'];

    $fetch_sql = "SELECT r_course, r_status FROM tb_registration WHERE r_tid = ?";
    $fetch_stmt = $con->prepare($fetch_sql);
    $fetch_stmt->bind_param("s", $r_tid);
    $fetch_stmt->execute();
    $fetch_stmt->bind_result($course, $status);
    $fetch_stmt->fetch();
    $fetch_stmt->close();

    $delete_sql = "DELETE FROM tb_registration WHERE r_tid = ?";
    $delete_stmt = $con->prepare($delete_sql);
    $delete_stmt->bind_param("s", $r_tid);

    if ($delete_stmt->execute()) {
        
        if ($status == 2) {
            $update_course_sql = "UPDATE tb_course SET c_current_student = c_current_student - 1 WHERE c_code = ?";
            $update_course_stmt = $con->prepare($update_course_sql);
            $update_course_stmt->bind_param("s", $course);
            $update_course_stmt->execute();
            $update_course_stmt->close();
        }

        echo "<script>alert('Registration deleted successfully.'); window.location.href = 'staffAmendRegistration.php';</script>";
    } else {
        echo "<script>alert('Error deleting registration.'); window.location.href = 'staffAmendRegistration.php';</script>";
    }

    $delete_stmt->close();
} else {
    echo "<script>alert('Invalid request.'); window.location.href = 'staffAmendRegistration.php';</script>";
}

$con->close();
?>
