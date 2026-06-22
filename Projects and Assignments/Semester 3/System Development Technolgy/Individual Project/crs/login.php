<?php include 'mainNav.php'; ?>

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h2 class="card-title mb-0">Login</h2>
    </div>
    <div class="card-body">
      <form method="POST" action="loginProcess.php">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Please enter your staff or student number</label>
          <input type="text" name="funame" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your staff or student ID" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Enter your password</label>
          <input type="password" name="fpwd" class="form-control" id="exampleInputPassword1" placeholder="Enter Password" autocomplete="off" required>
        </div>

        <button type="submit" class="btn btn-primary">Log in</button>
      </form>
    </div>
  </div>
</div>

</body>

</html>