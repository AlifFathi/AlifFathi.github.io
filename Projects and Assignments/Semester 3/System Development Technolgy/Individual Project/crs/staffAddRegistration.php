<?php
include('dbconnect.php');

if (isset($_POST['add_course'])) {
    $selected_student = $_POST['selected_student'];
    $selected_course = $_POST['selected_course'];
    $current_semester = "2024/2025-2";

    $check_sql = "SELECT * FROM tb_registration WHERE r_student = ? AND r_course = ?";
    $check_stmt = $con->prepare($check_sql);
    $check_stmt->bind_param("ss", $selected_student, $selected_course);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "<script>alert('Student is already registered for this course.'); window.history.back();</script>";
    } else {

        $course_sql = "SELECT c_current_student, c_max_student FROM tb_course WHERE c_code = ?";
        $course_stmt = $con->prepare($course_sql);
        $course_stmt->bind_param("s", $selected_course);
        $course_stmt->execute();
        $course_result = $course_stmt->get_result();
        $course_data = $course_result->fetch_assoc();

        $current_student_count = $course_data['c_current_student'];
        $max_student_count = $course_data['c_max_student'];

        if ($current_student_count >= $max_student_count) {
            $status = 1; // Pending status
        } else {
            $status = 2; // Approved status
        }


        $insert_sql = "INSERT INTO tb_registration (r_student, r_course, r_status, r_sem) VALUES (?, ?, ?, ?)";
        $insert_stmt = $con->prepare($insert_sql);
        $insert_stmt->bind_param("ssis", $selected_student, $selected_course, $status, $current_semester);

        if ($insert_stmt->execute()) {
            if ($status == 2) {

                $update_sql = "UPDATE tb_course SET c_current_student = c_current_student + 1 WHERE c_code = ?";
                $update_stmt = $con->prepare($update_sql);
                $update_stmt->bind_param("s", $selected_course);

                if ($update_stmt->execute()) {
                    echo "<script>alert('Registration added successfully.'); window.history.back();</script>";
                } else {
                    echo "<script>alert('Error updating course student count.'); window.history.back();</script>";
                }
            } else {
                echo "<script>alert('Registration added successfully. Status: Pending (Course is full).'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Error adding registration.'); window.history.back();</script>";
        }
    }
} else {
    echo "<script>alert('Invalid request.'); window.history.back();</script>";
}
?>