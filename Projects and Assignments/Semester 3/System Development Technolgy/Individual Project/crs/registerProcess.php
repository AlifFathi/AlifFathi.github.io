<?php

//Connect to DB
include('dbconnect.php');

//retrieve data from form
$funame = $_POST['funame'];
$fpwd = $_POST['fpwd'];
$fconfirmpwd = $_POST['fconfirmpwd'];
$femail = $_POST['femail'];
$fname = $_POST['fname'];
$fcontact = $_POST['fcontact'];
$fstate = $_POST['fstate'];

// Validate password match
if ($fpwd !== $fconfirmpwd) {
    echo ('<script>alert("Passwords do not match. Please try again.");
    window.location.href = "register.php";
    </script>');
    exit();
}

$hashed_password = password_hash($fpwd, PASSWORD_DEFAULT);

//SQL Insert Operation
$sql = "INSERT INTO tb_user (u_sno, u_pwd, u_email, u_name, u_contact, u_state, u_reg, u_utype)
        VALUES (?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP(), '2')";

$stmt = $con->prepare($sql);
$stmt->bind_param("ssssss", $funame, $hashed_password, $femail, $fname, $fcontact, $fstate);

//Execute SQL
$status = $stmt->execute();

//Confirmation registration successful or fail
if($status)
{
    echo ('<script>alert("Registration Successful")
    window.location.href = "login.php"
    </script>'); //window.location.href for redirect
}
else
{
    echo ('<script>alert("Registration Failed")
    window.location.href = "register.php"
    </script>');
}

//Close connection
$stmt->close();
$con->close();

?>
