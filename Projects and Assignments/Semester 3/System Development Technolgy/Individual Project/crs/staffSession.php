<?php
if(!session_id()){

    session_start();
}

if(!isset($_SESSION['staff_sid'])) {

    header("location:index.php");
}
?>