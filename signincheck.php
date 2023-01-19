<?php
    session_start();
    include "config.php";

    $conn = mysqli_connect($server, $user, $pass, $db);

    if ($conn) {
        $uname = $_POST['uname-signin'];
        $pass = $_POST['password-signin'];
        $email = $_POST['email'];

        $sqlu = "SELECT * FROM $usertable WHERE uname='$uname'";
        $sqle = "SELECT * FROM $usertable WHERE email='$email'";
        $resu = mysqli_query($conn, $sqlu);
        $rese = mysqli_query($conn, $sqle);

        if(mysqli_num_rows($resu) > 0){
            $uerror = "This username has already been taken. Please go for another one.";
            $_SESSION['utaken'] = $uerror;
            header("Location: index.php");
        }else if(mysqli_num_rows($rese) > 0){
            $eerror = "An user has already signed-in with this Email ID. Please use an other Email ID or try to Log in.";
            $_SESSION['etaken'] = $eerror;
            header("Location: index.php");
        }else{
            $sqlins = "INSERT INTO usertable (uname, pwd, email)
            VALUES ('$uname', '$pass', '$email')";
            if (mysqli_query($conn, $sqlins)) {
                $_SESSION['user'] = $uname;
                header("Location: hub.php");
            } else {
                echo "ERROR WHILE INSERTING INTO TABLE !  "."<br>".mysqli_error($conn);
            }
        }
    }

    mysqli_close($conn);
?>