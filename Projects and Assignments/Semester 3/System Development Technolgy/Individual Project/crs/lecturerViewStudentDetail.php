<?php
include 'lecturerSession.php';
include 'dbconnect.php';
include 'lecturerNav.php';

if (isset($_GET['student_id']) && isset($_GET['course_id']) && isset($_GET['semester'])) {
    $student_id = $_GET['student_id'];
    $course_code = $_GET['course_id'];
    $semester = $_GET['semester'];
} else {
    die("Student ID, Course Code, and Semester are required.");
}

$sql_student = "SELECT tb_user.u_sno, tb_user.u_name, tb_user.u_email, tb_user.u_contact, tb_user.u_state, tb_course.c_name
                FROM tb_user
                JOIN tb_registration ON tb_user.u_sno = tb_registration.r_student
                JOIN tb_course ON tb_registration.r_course = tb_course.c_code
                WHERE tb_user.u_sno = ? AND tb_registration.r_course = ? AND tb_registration.r_sem = ? AND tb_user.u_utype = 2";
                
$stmt_student = $con->prepare($sql_student);
$stmt_student->bind_param('sss', $student_id, $course_code, $semester);
$stmt_student->execute();
$result_student = $stmt_student->get_result();
$student = $result_student->fetch_assoc();

if (!$student) {
    die("Student not found or not enrolled in the specified course and semester.");
}
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title mb-0">Student Details</h2>
        </div>
        <div class="card-body">
            <h3><?php echo $student['u_name']; ?></h3>
            <p><strong>Student ID:</strong> <?php echo $student['u_sno']; ?></p>
            <p><strong>Email:</strong> <?php echo $student['u_email']; ?></p>
            <p><strong>Phone:</strong> <?php echo $student['u_contact']; ?></p>
            <p><strong>Address:</strong> <?php echo $student['u_state']; ?></p>
            <p><strong>Course:</strong> <?php echo $course_code . ' - ' . $student['c_name']; ?></p>
            <p><strong>Semester:</strong> <?php echo $semester; ?></p>

            <a href="lecturerViewStudentList.php?course_id=<?php echo $course_code; ?>&semester=<?php echo $semester; ?>" class="btn btn-secondary">Back to Student List</a>
        </div>
    </div>
</div>
</body>

</html>