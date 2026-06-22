<?php
include('studentSession.php');
include('studentNav.php');
include ('dbconnect.php');

$user_id = $_SESSION['funame'];
$query = "SELECT * FROM tb_user WHERE u_sno = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();
$stmt->close();
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title mb-0">Student Dashboard</h2>
        </div>
        <div class="card-body">
            <h3 class="mb-4">Student Profile</h3>
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr>
                        <th scope="row">User ID</th>
                        <td><?php echo $user_data['u_sno']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Name</th>
                        <td><?php echo $user_data['u_name']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td><?php echo $user_data['u_email']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Contact</th>
                        <td><?php echo $user_data['u_contact']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">State</th>
                        <td><?php echo $user_data['u_state']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


</body>
</html>
