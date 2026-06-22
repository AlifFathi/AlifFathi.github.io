<?php
include('staffSession.php');
include('dbconnect.php');
include('staffNav.php');

if (!isset($_GET['r_tid'])) {
    echo "<p class='alert alert-danger'>Invalid request.</p>";
    exit;
}

$r_tid = $_GET['r_tid'];

$stmt = $con->prepare("SELECT tb_registration.*, tb_course.c_name FROM tb_registration 
                       LEFT JOIN tb_course ON tb_registration.r_course = tb_course.c_code 
                       WHERE tb_registration.r_tid = ?");
$stmt->bind_param("s", $r_tid);
$stmt->execute();
$result = $stmt->get_result();

if (mysqli_num_rows($result) == 0) {
    echo "<p class='alert alert-danger'>No registration found.</p>";
    exit;
}

$registration = mysqli_fetch_assoc($result);

$courses_sql = "SELECT c_code, c_name FROM tb_course";
$courses_result = mysqli_query($con, $courses_sql);
$courses = [];
while ($row = mysqli_fetch_assoc($courses_result)) {
    $courses[] = $row;
}

$status_sql = "SELECT s_id, s_desc FROM tb_status";
$status_result = mysqli_query($con, $status_sql);
$statuses = [];
while ($row = mysqli_fetch_assoc($status_result)) {
    $statuses[] = $row;
}
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title mb-0">Modify Student Registration</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="staffProcessUpdate.php">
                <input type="hidden" name="r_tid" value="<?php echo $registration['r_tid']; ?>">
                
                <div class="form-group">
                    <label for="r_course">Course:</label>
                    <select name="r_course" id="r_course" class="form-control" required>
                        <?php foreach ($courses as $course) : ?>
                            <option value="<?php echo $course['c_code']; ?>" <?php echo ($registration['r_course'] == $course['c_code']) ? 'selected' : ''; ?>>
                                <?php echo $course['c_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="r_status">Status:</label>
                    <select name="r_status" id="r_status" class="form-control" required>
                        <?php foreach ($statuses as $status) : ?>
                            <option value="<?php echo $status['s_id']; ?>" <?php echo ($registration['r_status'] == $status['s_id']) ? 'selected' : ''; ?>>
                                <?php echo $status['s_desc']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <br>
                <button type="submit" class="btn btn-success">Update Registration</button>
                <a href="staffAmendRegistration.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
