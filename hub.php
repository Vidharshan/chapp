<?php
        session_start();
        include 'config.php';
        $conn = mysqli_connect($server, $user, $pass,$db); 
        //newChatRooom
        if($_POST["newchat"]??""){
            $hubs = mysqli_query($conn, "SELECT * FROM chathubs");
            //prevents duplicate or empty chat-room names 
            $i=1;
                while ($row = mysqli_fetch_array($hubs)) 
                    if($row['room_name']==$_POST["room_name"]??""){
                        $i=0;break;
                    }
            $room_name=$_POST["room_name"]??"";
            if($i && $room_name!=""){
                $room_name=$_POST["room_name"]??"";

                if($_POST["private_room"]??""){
                    $private_room=1;}

                else {$private_room=0;}
                $c=1;
                $code=random_int(10000,99999);;
                while($c){
                    $c=0;
                while ($row = mysqli_fetch_array($hubs)) {
                    $code=random_int(10000,99999);
                    if($row['room_code']==$code){
                        $c=1; break;}
                    }   
                }
                $room_code=($code);
                $_SESSION['room']=$code;
                $query="INSERT INTO `chathubs`(`room_name`, `user_count`, `private_room`, `room_code`) 
                VALUES ('$room_name','0','$private_room','$room_code')";
                //echo '<script>alert( "CHAT SUCCESSFULLY CREATED, ChAT coDe:$room_code")</script>';
                //echo "CHAT SUCCESSFULLY CREATED, ChAT coDe:$room_code";
                mysqli_query($conn, $query);
                header('Location: chat.php');
                
            }
            else if(!$i)
                echo "<p style='color: white;'>Chat room name exists, enter another</p>";
            else
                echo "<p style='color: white;'>Invalid chatname</p>";
        }
        //join private chat
        if($_POST["joinchat"]??""){
            $code= $_POST["join_room"]??"";
            $query=mysqli_fetch_array(mysqli_query($conn,"SELECT `room_name`, `user_count`, `private_room`, `room_code` FROM `chathubs` WHERE room_code=$code"));
            //chatcode validation
            if($query)
                {
                $_SESSION['room']=$query['room_code'];
                header('Location: chat.php');}
            else
                echo "invalid chat-code ";
        }
    ?>
<html> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Satisfy|Acme|Righteous|Pacifico|Courgette">   
    <style>
      
        body{
        background-image: url("chat_bg.jpg");
        background-repeat: no-repeat; 
        background-size: cover; 
        background-attachment: fixed;
            }
        .sub{
            margin-top: 5%;
                border: none;
                padding: 10px;
                color: #14063a;
                font-family: "Acme";
                font-size: 17px;
                background: linear-gradient(to right, #96d3ff, #ac66cc, #3b14a7);
                border-radius: 25px;
                cursor: pointer;
                width: wrap;
            }
        .input{
            margin-top: 5%;
                border: none;
                padding: 10px;
                color: #14063a;
                font-family: "Acme";
                font-size: 17px;
                background:#eaeaff;
                border-radius: 25px;
                width: wrap;
            }
        .txt{
                color: #ffff;
                font-family: "Acme";
                font-size: 20px;
                margin-top: 0%;
                text-align: center;
            } 
            
        h1{
                color: #ffff;
                font-family: "Courgette";
                font-size: 30px;
                margin-top: 0%;
                margin-left: 15px;
                text-align: center;
            }  
        a{
            background-color: rgba(0, 0, 0, 0.5);
            color: #eaeaff;
            font-size: 20px;
            margin-left: 30px;
            padding: 2px;

        }
    </style>

    <body>
       
        <div style="margin-top: 10%; float:left">
            <h1 >Currently active chat rooms</h1>
            <?php 
                
                $hubs = mysqli_query($conn, "SELECT * FROM chathubs");
                while ($row = mysqli_fetch_array($hubs)) {
                if(!$row['private_room']){
                    $room_code_temp=$row['room_code'];
                    echo "<a href='tochat.php?room=$room_code_temp'> {$row['room_name']}--{$row['user_count']}</a><br>";}}
            ?>
        </div>
        
        <div style="float: right; margin-right:20%; margin-top:5%">
        
            <h1> Create new chat</h1>
            <form method="POST", action="">
                <h4 class txt style="color: white;">Enter Chat Name:</h4>
                <input type="text" name="room_name" class="input"><br><br>
                <label> <input type="checkbox" class="txt" name="private_room" class="sub"> <span style="color: white;">private chat</span></label><br><br>          
                <input type="submit" name="newchat" class="sub" value="Create Chatroom"><br>
                <h1>.</h1>
                <h1> Join existing chat</h1>
                <input type="text" name="join_room" class="input" ><br>
                <input type="submit" name="joinchat" class="sub" value="Join Chatroom"><br>
            </form>

        </div>
        
    <?php mysqli_close($conn); ?>

    </body>
</html>
