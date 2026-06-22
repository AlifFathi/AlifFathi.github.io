<?php
include 'dbconnect.php';
include 'studentSession.php';

$user_id = $_SESSION['funame'];
$current_semester = "2024/2025-2";

if (isset($_SESSION['draft_courses'])) {
    $selected_courses = $_SESSION['draft_courses'];
} else {
    $selected_courses = array();
}

if (count($selected_courses) > 0) {
    $already_registered = []; // Array to track duplicate courses
    $registered_courses = [];

    foreach ($selected_courses as $course_id) {

        $sql_check = "SELECT * FROM tb_registration WHERE r_student = ? AND r_course = ? AND r_sem = ?";
        $stmt_check = $con->prepare($sql_check);
        $stmt_check->bind_param('sss', $user_id, $course_id, $current_semester);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows > 0) {
            $already_registered[] = $course_id;
        } else {
            $sql_course = "SELECT c_current_student, c_max_student FROM tb_course WHERE c_code = ?";
            $stmt_course = $con->prepare($sql_course);
            $stmt_course->bind_param('s', $course_id);
            $stmt_course->execute();
            $course_result = $stmt_course->get_result();

            if ($course_result->num_rows > 0) {
                $course_data = $course_result->fetch_assoc();
                $c_current_student = $course_data['c_current_student'];
                $c_max_student = $course_data['c_max_student'];

                if ($c_current_student < $c_max_student) {
                    $status = 2;
                } else {
                    $status = 1;
                }

                $sql_insert = "INSERT INTO tb_registration (r_student, r_course, r_status, r_sem) VALUES (?, ?, ?, ?)";
                $stmt_insert = $con->prepare($sql_insert);
                $stmt_insert->bind_param('ssis', $user_id, $course_id, $status, $current_semester);
                $stmt_insert->execute();

                if ($status == 2) {
                    $new_current_student = $c_current_student + 1;
                    $sql_update = "UPDATE tb_course SET c_current_student = ? WHERE c_code = ?";
                    $stmt_update = $con->prepare($sql_update);
                    $stmt_update->bind_param('is', $new_current_student, $course_id);
                    $stmt_update->execute();
                }

                $registered_courses[] = $course_id;
            }
        }
    }

    if (count($registered_courses) > 0 && count($already_registered) > 0) {
        echo "<script>alert('Some courses were successfully registered, but the following courses were already registered: " . implode(", ", $already_registered) . "'); window.location.href = 'studentRegisterCourse.php';</script>";
    } elseif (count($registered_courses) > 0) {
        echo "<script>alert('Courses registered successfully!'); window.location.href = 'studentRegisterCourse.php';</script>";
    } else {
        echo "<script>alert('All selected courses have already been registered!'); window.location.href = 'studentRegisterCourse.php';</script>";
    }

    unset($_SESSION['draft_courses']); // Clear draft after submission
} else {
    echo "<script>alert('No courses selected!'); window.location.href = 'studentRegisterCourse.php';</script>";
}
