<?php  
session_start();
include ('dbconnect.php');

// Retrieve data from form
$fuid = $_POST['funame'];
$fpwd = $_POST['fpwd'];

// SQL Retrieve operation to get user data from DB (without comparing password)
$sql = "SELECT * FROM tb_user WHERE u_sno = '$fuid'";

// Execute SQL
$result = mysqli_query($con, $sql);

// Retrieve data
$row = mysqli_fetch_array($result);

// Check if the user exists
if ($row) {

    if (password_verify($fpwd, $row['u_pwd'])) {

        // Rule-based AI login
        if ($row['u_utype'] == 1) { 

            $_SESSION['lecturer_sid'] = session_id();
            $_SESSION['funame'] = $fuid;
            mysqli_close($con);
            echo '<script>
                alert("Login successful as lecturer!");
                window.location.href = "lecturerDashboard.php";
                </script>';
        }
        if ($row['u_utype'] == 2) { 

            $_SESSION['student_sid'] = session_id();
            $_SESSION['funame'] = $fuid;
            mysqli_close($con);
            echo '<script>
                alert("Login successful as student!");
                window.location.href = "studentDashboard.php";
                </script>';
        }
        if ($row['u_utype'] == 3) { 

            $_SESSION['staff_sid'] = session_id();
            $_SESSION['funame'] = $fuid;
            mysqli_close($con);
            echo '<script>
                alert("Login successful as IT staff!");
                window.location.href = "staffDashboard.php";
                </script>';
        }
    } else {
        // Incorrect password
        echo '<script>
            alert("Invalid password. Please try again.");
            window.location.href = "login.php";
            </script>';
    }
} else {
    // User not found
    echo '<script>
        alert("User not found. Please check your ID and try again.");
        window.location.href = "login.php";
        </script>';
}

// Close the database connection
mysqli_close($con);
?>
