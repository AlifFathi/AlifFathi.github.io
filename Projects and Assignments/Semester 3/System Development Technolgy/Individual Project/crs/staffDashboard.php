<?php
include('staffSession.php');
include('staffNav.php');
include('dbconnect.php');

$user_id = $_SESSION['funame'];
$query = "SELECT * FROM tb_user WHERE u_sno = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();
$stmt->close();

$query2 = "SELECT COUNT(*) as student_count FROM tb_user WHERE u_utype = 2";
$result2 = $con->query($query2);
$student_count = $result2->fetch_assoc()['student_count'];

$query3 = "SELECT COUNT(*) as course_count FROM tb_course";
$result3 = $con->query($query3);
$course_count = $result3->fetch_assoc()['course_count'];
?>

<div class="container mt-5">
	<div class="card shadow">
		<div class="card-header bg-primary text-white">
			<h2 class="card-title mb-0">Staff Dashboard</h2>
		</div>
		<div class="card-body">
			<h3 class="mb-4">Staff Profile</h3>
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

			<h3 class="mt-5 mb-4">System Overview</h3>
			<div class="row">
				<div class="col-md-6">
					<div class="card bg-info text-white mb-4">
						<div class="card-body">
							<h5 class="card-title">Total Students</h5>
							<h2 class="display-4"><?php echo $student_count; ?></h2>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card bg-success text-white mb-4">
						<div class="card-body">
							<h5 class="card-title">Total Courses</h5>
							<h2 class="display-4"><?php echo $course_count; ?></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


</body>

</html>