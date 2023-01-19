<?php
session_start();

$message = "<p><span id='uname'>" . $_SESSION['user'] . "</span>: " . $_POST['message'] . "</p>\n";
if (!file_exists($_POST['link'])) exit;
file_put_contents($_POST['link'], $message, FILE_APPEND);
?>