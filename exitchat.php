<?php
  session_start();
  include "config.php";

  if (isset($_SESSION['room'])) {
    $room = $_SESSION['room'];
  } else {
    header("Location: hub.php");
    exit;
  }

  $conn = mysqli_connect($server, $user, $pass, $db);
  if (!$conn) {
    echo "An error has occured";
    exit;
  } else {
    $update_query = "UPDATE $chattable SET user_count=user_count-1 WHERE room_code=$room";
    mysqli_query($conn, $update_query);

    $check_query = "SELECT user_count FROM $chattable WHERE room_code=$room";
    $result = mysqli_query($conn, $check_query);
    $row = mysqli_fetch_array($result);
    echo $row['user_count'];
    if ($row['user_count'] <= 0) {
      if (file_exists("chatlogs/$room.html")) {
        unlink("chatlogs/$room.html");
      }

      $delete_query = "DELETE FROM $chattable WHERE room_code=$room";
      mysqli_query($conn, $delete_query);
    }

    unset($_SESSION['room']);
    unset($_SESSION['inroom']);
    header("Location: hub.php");
  }

  mysqli_close($conn);
?>