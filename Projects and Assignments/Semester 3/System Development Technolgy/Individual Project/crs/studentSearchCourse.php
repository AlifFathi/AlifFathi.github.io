<?php
include('studentSession.php');
include('dbconnect.php');
include('studentNav.php');

if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
} else {
    $search_query = '';
}

$sql = "SELECT * FROM tb_course WHERE c_code LIKE ? OR c_name LIKE ?";
$stmt = $con->prepare($sql);
$search_param = '%' . $search_query . '%';
$stmt->bind_param('ss', $search_param, $search_param);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title mb-0">Search Courses</h2>
        </div>
        <div class="card-body">
            <form action="" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search by course code or name" value="<?php echo $search_query; ?>">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Course Code</th>
                            <th>Course Name</th>
                            <th>Credit Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $row['c_code']; ?></td>
                                <td><?php echo $row['c_name']; ?></td>
                                <td><?php echo $row['c_credit']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
