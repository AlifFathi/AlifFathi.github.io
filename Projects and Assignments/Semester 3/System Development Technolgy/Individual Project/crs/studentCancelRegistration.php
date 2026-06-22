<?php
include('studentSession.php');
include('dbconnect.php');
include('studentNav.php');

$uic = $_SESSION['funame'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $r_tid = $_POST['r_tid'];

    $delete_sql = "DELETE FROM tb_registration WHERE r_tid = ? AND r_student = ?";
    $stmt = $con->prepare($delete_sql);
    $stmt->bind_param("ss", $r_tid, $uic);
    
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Registration cancelled successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error cancelling registration.</div>";
    }
}

$sql = "SELECT r.*, c.c_name FROM tb_registration r
    LEFT JOIN tb_course c ON r.r_course = c.c_code
    WHERE r_student = ?";
    
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $uic);
$stmt->execute();
$result = $stmt->get_result();
$result = mysqli_query($con, $sql);
?>

<div class="container mt-4">
    <h2>Cancel Registration</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Course</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['r_tid']); ?></td>
                    <td><?php echo htmlspecialchars($row['c_name']); ?></td>
                    <td>
                        <form method="POST" onsubmit="return confirm('Are you sure you want to cancel this registration?');">
                            <input type="hidden" name="r_tid" value="<?php echo $row['r_tid']; ?>">
                            <button type="submit" class="btn btn-danger">Cancel</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>

</html>
