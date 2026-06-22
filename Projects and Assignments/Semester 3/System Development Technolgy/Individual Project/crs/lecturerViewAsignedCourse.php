<?php
include 'lecturerSession.php';
include 'dbconnect.php';
include 'lecturerNav.php';

$user_id = $_SESSION['funame'];

$sql_semesters = "SELECT DISTINCT r_sem FROM tb_registration ORDER BY r_sem DESC";
$semesters_result = $con->query($sql_semesters);

if (isset($_GET['semester'])) {
    $selected_semester = $_GET['semester'];
} else {
    $selected_semester = null;
}

if (!$selected_semester && $semesters_result->num_rows > 0) {
    $selected_semester = $semesters_result->fetch_assoc()['r_sem'];
}

// Fetch assigned courses for the selected semester
$sql = "SELECT DISTINCT tb_course.c_code, tb_course.c_name, tb_course.c_credit
        FROM tb_course
        JOIN tb_registration ON tb_course.c_code = tb_registration.r_course
        WHERE tb_course.c_lec = ? AND tb_registration.r_sem = ?
        ORDER BY tb_course.c_code";

$stmt = $con->prepare($sql);
$stmt->bind_param('ss', $user_id, $selected_semester);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title mb-0">Assigned Courses</h2>
        </div>
        <div class="card-body">
            <form method="GET" class="mb-4">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <label for="semester" class="col-form-label">Select Semester:</label>
                    </div>
                    <div class="col-auto">
                        <select name="semester" id="semester" class="form-select" onchange="this.form.submit()">
                            <?php
                            $semesters_result->data_seek(0);
                            while ($row = $semesters_result->fetch_assoc()) {
                                $semester = $row['r_sem'];
                                $selected = ($semester == $selected_semester) ? 'selected' : '';
                                echo "<option value='$semester' $selected>$semester</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </form>

            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Course Code</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Credit Hours</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($course = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $course['c_code']; ?></td>
                            <td><?php echo $course['c_name']; ?></td>
                            <td><?php echo $course['c_credit']; ?></td>
                            <td>
                                <a href="lecturerViewStudentList.php?course_id=<?php echo $course['c_code']; ?>&semester=<?php echo $selected_semester; ?>" class="btn btn-sm btn-primary">View Students</a>
                                <a href="lecturerViewCourseDetail.php?course_id=<?php echo $course['c_code']; ?>" class="btn btn-sm btn-info">View Details</a>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>

            <div class="mt-4">
                <a href="lecturerDashboard.php" class="btn btn-secondary">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>

</body>

</html>