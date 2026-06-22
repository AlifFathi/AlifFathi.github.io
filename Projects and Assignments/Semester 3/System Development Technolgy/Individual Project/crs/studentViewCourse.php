<?php

include('studentSession.php');
include ('dbconnect.php');
include ('studentNav.php');

$uic = $_SESSION['funame'];

$sql = "SELECT * FROM tb_registration
		LEFT JOIN tb_course ON tb_registration.r_course = tb_course.c_code
		LEFT JOIN tb_status ON tb_registration.r_status = tb_status.s_id
		WHERE r_student = '$uic'";

$result = mysqli_query($con, $sql);

?>

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h2 class="card-title mb-0">Registered Courses</h2>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th scope="col">Transaction ID</th>
            <th scope="col">Semester</th>
            <th scope="col">Course Code</th>
            <th scope="col">Course Name</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_array($result))
          {
            echo "<tr>";
            echo "<td>".$row['r_tid']."</td>";
            echo "<td>".$row['r_sem']."</td>";
            echo "<td>".$row['r_course']."</td>";
            echo "<td>".$row['c_name']."</td>";
            echo "<td>".$row['s_desc']."</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>

</html>
