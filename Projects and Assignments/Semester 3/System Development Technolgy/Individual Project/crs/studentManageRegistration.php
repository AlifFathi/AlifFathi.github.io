<?php
include('studentSession.php');
include('dbconnect.php');
include('studentNav.php');

$uic = $_SESSION['funame'];

$sql = "SELECT r.*, c.c_name FROM tb_registration r
    LEFT JOIN tb_course c ON r.r_course = c.c_code
    WHERE r_student = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $uic);
$stmt->execute();
$result = $stmt->get_result();

$courses_sql = "SELECT c_code, c_name FROM tb_course";
$courses_result = mysqli_query($con, $courses_sql);
$courses = [];
while ($course_row = mysqli_fetch_assoc($courses_result)) {
    $courses[] = $course_row;
}
?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title mb-0">Manage Registrations</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Current Course</th>
                            <th>New Course</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $row['r_tid']; ?></td>
                                <td><?php echo $row['c_name']; ?></td>
                                <td>
                                    <form method="POST" action="studentUpdateRegistration.php" class="d-inline">
                                        <select name="new_course" class="form-select d-inline" style="width: auto;">
                                            <?php foreach ($courses as $course) : ?>
                                                <option value="<?php echo $course['c_code']; ?>"><?php echo $course['c_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="hidden" name="r_tid" value="<?php echo $row['r_tid']; ?>">
                                        <input type="hidden" name="action" value="modify">
                                        <button type="submit" class="btn btn-primary btn-sm ms-2">Modify</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" action="studentUpdateRegistration.php" class="d-inline" onsubmit="return confirm('Are you sure you want to cancel this registration?');">
                                        <input type="hidden" name="r_tid" value="<?php echo $row['r_tid']; ?>">
                                        <input type="hidden" name="action" value="cancel">
                                        <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
