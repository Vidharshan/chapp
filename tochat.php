<?php
  session_start();
  $_SESSION['room'] = $_GET['room'];
  header("Location: chat.php");
?>