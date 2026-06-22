<?php
include('staffSession.php');
include('dbconnect.php');
include('staffNav.php');

$sql = "SELECT * FROM tb_course";
$result = mysqli_query($con, $sql);

$sql_lecturers = "SELECT u_sno, u_name FROM tb_user WHERE u_utype = 1";
$result_lecturers = $con->query($sql_lecturers);

?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title mb-0">Modify Courses</h2>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Credit Hours</th>
                        <th>Max Students</th>
                        <th>Assigned Lecturer</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo ($row['c_code']); ?></td>
                            <td><?php echo ($row['c_name']); ?></td>
                            <td><?php echo ($row['c_credit']); ?></td>
                            <td><?php echo ($row['c_max_student']); ?></td>
                            <td><?php echo ($row['c_lec']); ?></td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['c_code']; ?>">
                                    Edit
                                </button>

                                <a href="staffModifyDeleteCourse.php?c_code=<?php echo $row['c_code']; ?>" class="btn btn-danger btn-sm" onclick="return confirmDelete()">
                                    Delete
                                </a>
                            </td>
                        </tr>

                        <div class="modal fade" id="editModal<?php echo $row['c_code']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $row['c_code']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel<?php echo $row['c_code']; ?>">Edit Course: <?php echo ($row['c_code']); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="staffModifyCourseProcess.php" method="POST" onsubmit="return confirmChanges()">
                                            <input type="hidden" name="original_c_code" value="<?php echo ($row['c_code']); ?>">
                                            <div class="mb-3">
                                                <label for="c_code<?php echo $row['c_code']; ?>" class="form-label">Course Code:</label>
                                                <input type="text" class="form-control" id="c_code<?php echo $row['c_code']; ?>" name="c_code" value="<?php echo ($row['c_code']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="c_name<?php echo $row['c_code']; ?>" class="form-label">Course Name:</label>
                                                <input type="text" class="form-control" id="c_name<?php echo $row['c_code']; ?>" name="c_name" value="<?php echo ($row['c_name']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="c_credit<?php echo $row['c_code']; ?>" class="form-label">Credit Hours:</label>
                                                <input type="number" class="form-control" id="c_credit<?php echo $row['c_code']; ?>" name="c_credit" value="<?php echo ($row['c_credit']); ?>" min="1" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="c_max_student<?php echo $row['c_code']; ?>" class="form-label">Max Students:</label>
                                                <input type="number" class="form-control" id="c_max_student<?php echo $row['c_code']; ?>" name="c_max_student" value="<?php echo ($row['c_max_student']); ?>" min="1" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="c_lecturer_id<?php echo $row['c_code']; ?>" class="form-label">Assign Lecturer:</label>
                                                <select class="form-select" id="c_lecturer_id<?php echo $row['c_code']; ?>" name="c_lecturer_id" required>
                                                    <?php
                                                    mysqli_data_seek($result_lecturers, 0);
                                                    while ($lecturer = $result_lecturers->fetch_assoc()) {
                                                        echo "<option value='" . $lecturer['u_sno'] . "'>" . ($lecturer['u_name']) . " (" . ($lecturer['u_sno']) . ")</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <br><br>
</div>

<script>
    function confirmChanges() {
        return confirm('Are you sure you want to save these changes?');
    }

    function confirmDelete() {
        return confirm('Are you sure you want to delete this course? This action cannot be undone.');
    }
</script>

</body>

</html>