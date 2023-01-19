<?php
    session_start();
    include "config.php";

    $conn = mysqli_connect($server, $user, $pass, $db);

    if ($conn) {
        $uname = $_POST['uname-login'];
        $pass = $_POST['password-login'];

        $row="";
        $sqll = "SELECT * FROM $usertable WHERE uname='$uname'";
        $resl = mysqli_query($conn, $sqll);
        if(mysqli_num_rows($resl) > 0){
            $row = mysqli_fetch_assoc($resl);
            if($row['pwd'] == $pass){
                $_SESSION['user'] = $uname;
                header("location: hub.php");
            }
            else{
                $perror = "Incorrect Password";
                $_SESSION['pincorrect'] = $perror;
                header("location: index.php");
            }
        }
        else{
            $umessage = "User Not Found. Please Sign-in";
            $_SESSION['unotfound'] = $umessage;
            header("location: index.php");
        }
    }

    mysqli_close($conn);
?>