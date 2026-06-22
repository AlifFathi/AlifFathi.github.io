<?php
include 'lecturerSession.php';
include 'dbconnect.php';
include 'lecturerNav.php';

$course_id = $_GET['course_id'] ?? '';

if (empty($course_id)) {
    die("Course ID is required.");
}

$sql = "SELECT c_code, c_name, c_credit, c_max_student FROM tb_course WHERE c_code = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $course_id);
$stmt->execute();
$result = $stmt->get_result();
$course = $result->fetch_assoc();

if (!$course) {
    die("Course not found.");
}
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title mb-0">Course Details</h2>
        </div>
        <div class="card-body">
            <h3><?php echo $course['c_code'] . ' - ' . $course['c_name']; ?></h3>
            <br>
            <p><strong>Credit Hours:</strong> <?php echo $course['c_credit']; ?></p>
            <p><strong>Maximum Students:</strong> <?php echo $course['c_max_student']; ?></p>
            <a href="lecturerViewAsignedCourse.php" class="btn btn-secondary">Back to Assigned Courses</a>
        </div>
    </div>
</div>
</body>

</html>