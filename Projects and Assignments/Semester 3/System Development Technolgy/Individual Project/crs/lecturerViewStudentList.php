<?php
include 'lecturerSession.php';
include 'dbconnect.php';
include 'lecturerNav.php';

if (isset($_GET['course_id']) && isset($_GET['semester'])) {
    $course_code = $_GET['course_id'];
    $semester = $_GET['semester'];
} else {
    die("Course Code and Semester are required.");
}

$sql_course = "SELECT c_name FROM tb_course WHERE c_code = ?";
$stmt_course = $con->prepare($sql_course);
$stmt_course->bind_param('s', $course_code);
$stmt_course->execute();
$result_course = $stmt_course->get_result();
$course = $result_course->fetch_assoc();

if (!$course) {
    die("Course not found.");
}

$sql_students = "SELECT u_sno , u_name, u_email  
                 FROM tb_user
                 JOIN tb_registration ON tb_user.u_sno = tb_registration.r_student
                 WHERE r_course = ? AND r_sem = ? AND u_utype = 2
                 ORDER BY u_name";

$stmt_students = $con->prepare($sql_students);
$stmt_students->bind_param('ss', $course_code, $semester);
$stmt_students->execute();
$result_students = $stmt_students->get_result();
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title mb-0">Student List</h2>
        </div>
        <div class="card-body">
            <h3><?php echo $course_code . ' - ' . $course['c_name']; ?></h3>
            <p><strong>Semester:</strong> <?php echo $semester; ?></p>

            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($student = $result_students->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $student['u_sno']; ?></td>
                            <td><?php echo $student['u_name']; ?></td>
                            <td><?php echo $student['u_email']; ?></td>
                            <td>
                                <a href="lecturerViewStudentDetail.php?student_id=<?php echo $student['u_sno']; ?>&course_id=<?php echo $course_code; ?>&semester=<?php echo $semester; ?>" class="btn btn-primary btn-sm">View Details</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>


            <a href="lecturerViewAsignedCourse.php" class="btn btn-secondary">Back to Assigned Courses</a>
        </div>
    </div>
</div>
</body>

</html>