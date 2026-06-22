<?php

if(!session_id()){

    session_start();
}

if(!isset($_SESSION['student_sid'])) {

    header("location:index.php");
}

?>