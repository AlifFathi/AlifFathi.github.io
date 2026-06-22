<?php include 'mainNav.php'; ?>

<div class="container mt-4">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h2 class="card-title mb-0">Register</h2>
    </div>
    <div class="card-body">
      <form method="POST" action="registerProcess.php" onsubmit="return validatePassword()">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Please enter your staff or student number</label>
          <input type="text" name="funame" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your staff or student ID" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Create your password</label>
          <input type="password" name="fpwd" class="form-control" id="exampleInputPassword1" placeholder="Create Password" autocomplete="off" required>
        </div>

        <div class="mb-3">
          <label for="confirmPassword" class="form-label">Confirm your password</label>
          <input type="password" name="fconfirmpwd" class="form-control" id="confirmPassword" placeholder="Confirm Password" autocomplete="off" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Enter email address</label>
          <input type="email" name="femail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Enter your full name</label>
          <input type="text" name="fname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your full name according to IC" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Enter contact number</label>
          <input type="text" name="fcontact" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your mobile number" required>
        </div>

        <div class="mb-3">
          <label for="exampleSelect1" class="form-label">Select your state</label>
          <select name="fstate" class="form-select" id="exampleSelect1">
            <option>Perlis</option>
            <option>Perak</option>
            <option>Kedah</option>
            <option>Kelantan</option>
            <option>Terengganu</option>
            <option>Pulau Pinang</option>
            <option>Melaka</option>
            <option>Negeri Sembilan</option>
            <option>Pahang</option>
            <option>Johor</option>
            <option>Sabah</option>
            <option>Sarawak</option>
            <option>W.P. Kuala Lumpur</option>
            <option>W.P. Labuan</option>
            <option>W.P. Putrajaya</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Clear form</button>
      </form>
    </div>
  </div>
</div>

<script>
function validatePassword() {
  var password = document.getElementById("exampleInputPassword1").value;
  var confirmPassword = document.getElementById("confirmPassword").value;
  if (password != confirmPassword) {
    alert("Passwords do not match.");
    return false;
  }
  return true;
}
</script>

</body>
</html>
