<?php
include('staffSession.php');
include('staffNav.php');
include('dbconnect.php');

$sql_lecturers = "SELECT u_sno, u_name FROM tb_user WHERE u_utype = 1";

$result_lecturers = mysqli_query($con, $sql_lecturers);
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title mb-0">Add New Course</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="staffAddNewCourseProcess.php">
                <div class="mb-3">
                    <label for="course_code" class="form-label">Course Code:</label>
                    <input type="text" class="form-control" id="course_code" name="course_code" required>
                </div>

                <div class="mb-3">
                    <label for="course_name" class="form-label">Course Name:</label>
                    <input type="text" class="form-control" id="course_name" name="course_name" required>
                </div>
                <div class="mb-3">
                    <label for="credit_hour" class="form-label">Credit Hours:</label>
                    <input type="number" class="form-control" id="credit_hour" name="credit_hour" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="max_student" class="form-label">Max Students:</label>
                    <input type="number" class="form-control" id="max_student" name="max_student" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="lecturer_id" class="form-label">Assign Lecturer:</label>
                    <select class="form-select" id="lecturer_id" name="lecturer_id" required>
                        <option value="">Select a lecturer</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($result_lecturers)) {
                            echo "<option value='" . $row['u_sno'] . "'>" . ($row['u_name']) . " (" . ($row['u_sno']) . ")</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Course</button>
            </form>

            <div class="mt-4">
                <a href="staffDashboard.php" class="btn btn-secondary">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>

</body>

</html>