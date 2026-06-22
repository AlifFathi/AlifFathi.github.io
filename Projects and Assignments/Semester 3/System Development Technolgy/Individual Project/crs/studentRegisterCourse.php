<?php
include 'dbconnect.php';
include 'studentSession.php';
include 'studentNav.php';

$sql_courses = "SELECT * FROM tb_course";
$result_courses = $con->query($sql_courses);

if (!isset($_SESSION['draft_courses'])) {
  $_SESSION['draft_courses'] = array();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['select_courses'])) {
  if (isset($_POST['courses'])) {
    $_SESSION['draft_courses'] = $_POST['courses'];
  } else {
    $_SESSION['draft_courses'] = array();
  }
}

// Clear draft courses
if (isset($_GET['clear_draft'])) {
  $_SESSION['draft_courses'] = array(); // Clear the draft courses
  header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page to refresh
  exit();
}

function calculateTotalCreditHours($con, $draft_courses)
{
  $total_credit_hours = 0;
  foreach ($draft_courses as $course_code) {
    $sql = "SELECT c_credit FROM tb_course WHERE c_code = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $course_code);
    $stmt->execute();
    $result = $stmt->get_result();
    $credit_hours = $result->fetch_assoc()['c_credit'];
    $total_credit_hours += $credit_hours;
  }
  return $total_credit_hours;
}
?>

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h2 class="card-title mb-0">Select Courses</h2>
    </div>
    <div class="card-body">
      <form method="POST">
        <table class="table table-bordered table-hover">
          <thead class="table-light">
            <tr>
              <th scope="col">Select</th>
              <th scope="col">Course Code</th>
              <th scope="col">Course Name</th>
              <th scope="col">Credit Hours</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($course = $result_courses->fetch_assoc()) {
              echo "<tr>";
              echo "<td>";
              echo "<input class='form-check-input' type='checkbox' name='courses[]' value='" . $course['c_code'] . "'";
              if (in_array($course['c_code'], $_SESSION['draft_courses'])) {
                echo " checked";
              }
              echo ">";
              echo "</td>";
              echo "<td>" . $course['c_code'] . "</td>";
              echo "<td>" . $course['c_name'] . "</td>";
              echo "<td>" . $course['c_credit'] . "</td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
        <button type="submit" name="select_courses" class="btn btn-primary">Save Draft</button>
      </form>

      <h3 class="mt-4">Draft Courses</h3>
      <ul class="list-group">
        <?php
        $total_credit_hours = 0;
        foreach ($_SESSION['draft_courses'] as $draft_course_code) {
          $sql_course_info = "SELECT c_name, c_credit FROM tb_course WHERE c_code = '$draft_course_code'";
          $result_course_info = $con->query($sql_course_info);
          $course_info = $result_course_info->fetch_assoc();
          $total_credit_hours += $course_info['c_credit'];
          echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
          echo $course_info['c_name'];
          echo "<span class='badge bg-primary rounded-pill'>" . $course_info['c_credit'] . " credits</span>";
          echo "</li>";
        }
        ?>
      </ul>

      <div class="mt-3">
        <strong>Total Credit Hours: <?php echo $total_credit_hours; ?></strong>
      </div>

      <div class="mt-4">
        <a href="#" id="submitLink" class="btn btn-success">Proceed to Submit</a>
      </div>

      <div class="mt-4">
        <a href="?clear_draft=true" id="clearDraftLink" class="btn btn-danger">Clear Draft</a>
      </div>
    </div>
  </div>
  <br><br>
</div>

<script>
  document.getElementById('submitLink').addEventListener('click', function(event) {
    event.preventDefault();
    if (confirm("Are you sure?")) {
      window.location.href = 'studentRegisterCourseProcess.php';
    }
  });
</script>
</body>

</html>