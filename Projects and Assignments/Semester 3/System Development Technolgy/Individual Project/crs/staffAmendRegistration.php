<?php
include('staffSession.php');
include('dbconnect.php');
include('staffNav.php');

$students_sql = "SELECT u_sno, u_name FROM tb_user WHERE u_utype = '2'";
$students_result = mysqli_query($con, $students_sql);
$students = [];
while ($row = mysqli_fetch_assoc($students_result)) {
    $students[] = $row;
}

$courses_sql = "SELECT c_code, c_name, c_max_student, c_current_student FROM tb_course";
$courses_result = mysqli_query($con, $courses_sql);
$courses = [];
while ($row = mysqli_fetch_assoc($courses_result)) {
    $courses[$row['c_code']] = $row;
}

if (isset($_GET['selected_student'])) {
    $selected_student = $_GET['selected_student'];
    $sql = "SELECT tb_registration.*, tb_course.c_name, tb_course.c_max_student, tb_course.c_current_student, tb_status.s_desc 
            FROM tb_registration
            LEFT JOIN tb_course ON tb_registration.r_course = tb_course.c_code
            LEFT JOIN tb_status ON tb_registration.r_status = tb_status.s_id
            WHERE tb_registration.r_student = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $selected_student);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title mb-0">Manage Student Registrations</h2>
        </div>
        <div class="card-body">
            <form method="GET" class="mb-4">
                <div class="form-group">
                    <label for="selected_student">Select Student:</label>
                    <select name="selected_student" id="selected_student" class="form-control" onchange="this.form.submit()">
                        <option value="">Choose a student</option>
                        <?php foreach ($students as $student) : ?>
                            <?php if (isset($_GET['selected_student']) && $_GET['selected_student'] == $student['u_sno']) : ?>
                                <option value="<?php echo $student['u_sno']; ?>" selected>
                            <?php else : ?>
                                <option value="<?php echo $student['u_sno']; ?>">
                            <?php endif; ?>
                                <?php echo $student['u_name']; ?> (<?php echo $student['u_sno']; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
            <?php if (isset($_GET['selected_student']) && $_GET['selected_student'] !== '') : ?>
                <form method="POST" action="staffAddRegistration.php" class="mb-4">
                    <input type="hidden" name="selected_student" value="<?php echo $_GET['selected_student']; ?>">
                    <div class="form-group">
                        <label for="selected_course">Select Course to Add:</label>
                        <select name="selected_course" id="selected_course" class="form-control" required>
                            <option value="">Choose a course</option>
                            <?php foreach ($courses as $course) : ?>
                                <option value="<?php echo $course['c_code']; ?>">
                                    <?php echo $course['c_name']; ?> (<?php echo $course['c_code']; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br>
                    <button type="submit" name="add_course" class="btn btn-success">Add Course</button>
                </form>
            <?php endif; ?>

            <?php if (isset($result) && mysqli_num_rows($result) > 0) : ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Course Name</th>
                                <th>Max Students</th>
                                <th>Current Students</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td><?php echo $row['r_tid']; ?></td>
                                    <td><?php echo $row['c_name']; ?></td>
                                    <td><?php echo $row['c_max_student']; ?></td>
                                    <td><?php echo $row['c_current_student']; ?></td>
                                    <td><?php echo $row['s_desc']; ?></td>
                                    <td>
                                        <form method="GET" action="staffModifyRegistration.php" class="d-inline">
                                            <input type="hidden" name="r_tid" value="<?php echo $row['r_tid']; ?>">
                                            <button type="submit" class="btn btn-primary btn-sm">Modify</button>
                                        </form>
                                        <form method="POST" action="staffDeleteRegistration.php" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this registration?');">
                                            <input type="hidden" name="r_tid" value="<?php echo $row['r_tid']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php elseif (isset($_GET['selected_student'])) : ?>
                <p>No registrations found for this student.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>

</html>