<?php
include('studentSession.php');
include('dbconnect.php');

$uic = $_SESSION['funame'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $r_tid = $_POST['r_tid'];

        $fetch_sql = "SELECT r_course, r_status FROM tb_registration WHERE r_tid = ? AND r_student = ?";
        $fetch_stmt = $con->prepare($fetch_sql);
        $fetch_stmt->bind_param("ss", $r_tid, $uic);
        $fetch_stmt->execute();
        $fetch_stmt->bind_result($old_course, $r_status);
        $fetch_stmt->fetch();
        $fetch_stmt->close();

        if ($_POST['action'] == 'modify') {
            $new_course = $_POST['new_course'];

            $check_sql = "SELECT * FROM tb_registration WHERE r_course = ? AND r_student = ?";
            $check_stmt = $con->prepare($check_sql);
            $check_stmt->bind_param("ss", $new_course, $uic);
            $check_stmt->execute();
            $check_stmt->store_result();

            if ($check_stmt->num_rows > 0) {
                echo "<script>alert('You are already registered for this course.'); window.location.href = 'studentManageRegistration.php';</script>";
            } else {

                $check_capacity_sql = "SELECT c_current_student, c_max_student FROM tb_course WHERE c_code = ?";
                $check_capacity_stmt = $con->prepare($check_capacity_sql);
                $check_capacity_stmt->bind_param("s", $new_course);
                $check_capacity_stmt->execute();
                $check_capacity_stmt->bind_result($current_students, $max_students);
                $check_capacity_stmt->fetch();
                $check_capacity_stmt->close();

                if ($current_students >= $max_students) {

                    echo "<script>alert('The new course is full.'); window.location.href = 'studentManageRegistration.php';</script>";
                } else {

                    if ($r_status == 1 || $r_status == 2) {

                        if ($r_status == 2) {
                            $decrement_sql = "UPDATE tb_course SET c_current_student = c_current_student - 1 WHERE c_code = ?";
                            $decrement_stmt = $con->prepare($decrement_sql);
                            $decrement_stmt->bind_param("s", $old_course);
                            $decrement_stmt->execute();
                            $decrement_stmt->close();
                        }

                        $update_sql = "UPDATE tb_registration SET r_course = ?, r_status = 2 WHERE r_tid = ? AND r_student = ?";
                        $stmt = $con->prepare($update_sql);
                        $stmt->bind_param("sss", $new_course, $r_tid, $uic);

                        if ($stmt->execute()) {
                            
                            $increment_sql = "UPDATE tb_course SET c_current_student = c_current_student + 1 WHERE c_code = ?";
                            $increment_stmt = $con->prepare($increment_sql);
                            $increment_stmt->bind_param("s", $new_course);
                            $increment_stmt->execute();
                            $increment_stmt->close();

                            echo "<script>alert('Registration updated successfully.'); window.location.href = 'studentManageRegistration.php';</script>";
                        } else {
                            echo "<script>alert('Error updating registration.'); window.location.href = 'studentManageRegistration.php';</script>";
                        }
                    } else {
                        // Invalid status
                        echo "<script>alert('Invalid registration status.'); window.location.href = 'studentManageRegistration.php';</script>";
                    }
                }
            }
        } elseif ($_POST['action'] == 'cancel') {

            $delete_sql = "DELETE FROM tb_registration WHERE r_tid = ? AND r_student = ?";
            $stmt = $con->prepare($delete_sql);
            $stmt->bind_param("ss", $r_tid, $uic);

            if ($stmt->execute()) {

                if ($r_status == 2) {

                    $decrement_sql = "UPDATE tb_course SET c_current_student = c_current_student - 1 WHERE c_code = ?";
                    $decrement_stmt = $con->prepare($decrement_sql);
                    $decrement_stmt->bind_param("s", $old_course);
                    $decrement_stmt->execute();
                    $decrement_stmt->close();
                }

                echo "<script>alert('Registration cancelled successfully.'); window.location.href = 'studentManageRegistration.php';</script>";
            } else {
                echo "<script>alert('Error cancelling registration.'); window.location.href = 'studentManageRegistration.php';</script>";
            }
        }
    }
}
?>