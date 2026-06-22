<!DOCTYPE html>
<html lang="en">

<head>
  <title>Course Registration System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    .navbar-nav .nav-link {
      color: rgba(255, 255, 255, 0.8) !important;
      transition: color 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
      color: #ffffff !important;
    }
  </style>

</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="staffDashboard.php">CRS IT Staff</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="staffDashboard.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="StaffAddNewCourse.php">Add Course</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="StaffModifyCourse.php">Modify Course</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="StaffAmendRegistration.php">Amend Course Registration</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>