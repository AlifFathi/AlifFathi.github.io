<?php
include('studentSession.php');
include('dbconnect.php');
include('studentNav.php');

$uic = $_SESSION['funame'];

// Fetch current user data
$sql = "SELECT * FROM tb_user WHERE u_sno = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $uic);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $new_password = $_POST['new-password'];
    $confirm_password = $_POST['confirm-password'];

    // Update email and phone
    $update_sql = "UPDATE tb_user SET u_email = ?, u_contact = ? WHERE u_sno = ?";
    $update_stmt = $con->prepare($update_sql);
    $update_stmt->bind_param("sss", $email, $phone, $uic);
    $update_stmt->execute();

    // Update password if provided
    if (!empty($new_password) && $new_password == $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $password_sql = "UPDATE tb_user SET u_pwd = ? WHERE u_sno = ?";
        $password_stmt = $con->prepare($password_sql);
        $password_stmt->bind_param("ss", $hashed_password, $uic);
        $password_stmt->execute();
        echo "<div class='alert alert-success'>Profile and password updated successfully.</div>";
    } elseif (!empty($new_password) && $new_password !== $confirm_password) {
        echo "<div class='alert alert-danger'>Passwords do not match. Profile updated, but password was not changed.</div>";
    } else {
        echo "<div class='alert alert-success'>Profile updated successfully.</div>";
    }

    // Refresh user data
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}
?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title mb-0">Edit Profile</h2>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['u_email']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($user['u_contact']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="new-password" class="form-label">New Password:</label>
                    <input type="password" class="form-control" id="new-password" name="new-password">
                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirm-password">
                </div>
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
</div>


</body>
</html>
