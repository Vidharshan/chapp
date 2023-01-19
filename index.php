<?php
session_start();
include("config.php");

$conn = mysqli_connect($server, $user, $pass);
?>

<html>
    <head>
        <title>Chapp | Online Chatrooms</title>
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Satisfy|Acme|Righteous|Pacifico|Courgette">
        <style>

            body{
                background-image: url("chapp_bg1.jpg");
                background-repeat: no-repeat; 
                background-size: cover; 
                background-attachment: fixed;
                background-size: 100% 100%;
            }
            #heading{
                color: #ffff;
                text-align: center;
                margin-top: 10%;
                margin-bottom: 0%;
                font-family: "Satisfy";
                font-size: 140px;

            }
            #desc{
                text-align: center;
                color: #ffff;
                font-family: "Acme";
            }
            .butt{
                background: linear-gradient(to right, #96d3ff, #ac66cc, #3b14a7);
                font-size: 25px;
                font-family: "Acme";
                color: #14063a;
                cursor: pointer;
                padding: 10px;
                border-radius: 25px;

            }

            .buttons{
                text-align: center;
            }
            #parent-login, #parent-signin{
                margin-left: 39%;
               
            }
            #container-login, #container-signin{
                padding: 5%;
                background: linear-gradient(to bottom, #3b14a7, #96d3ff, #3b14a7);
                width: 220px;
                border-radius: 25px;
            }
            
            .title{
                color: #ffff;
                font-family: "Courgette";
                font-size: 30px;
                margin-top: 0%;
                text-align: center;
            }
            #uname-login, #password-login, #email, #uname-signin, #password-signin{
                width: 200px;
                font-size: 16px;
                padding: 10px;
                border-radius: 25px;

            }

            .form-error span {
                width:80%;
                height:35px;
                margin: 3px 10%;
                font-size: 15px;
                color: #d83d5a;
            }
            .form-error input{
                border:2px solid #d83d5a;
            }
            .floating-label{
                font-family: "Righteous";
            }
            .floating-label-grp{
                margin-top: 15px;
            }
            
            .sub{
                margin-top: 15%;
                border: none;
                padding: 10px;
                color: #14063a;
                font-family: "Acme";
                font-size: 17px;
                background: #eaeaff;
                border-radius: 25px;
                width: wrap;
            }
        </style>

        <script type="text/javascript" >
            function displayloginform(){
                
                document.getElementById("parent-login").style.display="block";
                document.getElementById("parent-signin").style.display="none";
                
            }
            function displaysigninform(){
                document.getElementById("parent-signin").style.display="block";
                document.getElementById("parent-login").style.display="none";
                
            }
                        
        </script>

    </head>

    <body>
        <p id="heading"><b>chapp</b></p>
        <p id="desc">Online chatrooms</p>
        <br><br>
        <div class="buttons">
        <button onclick="displayloginform()" class="butt" style="width: 95px;"> Log  in </button>
        <button onclick="displaysigninform()" class="butt" style="margin-left: 40px;">Sign in</button>
        </div>
        <br>
            
        <!--  Log in Form -->
        <div id="parent-login" style="display: 
        <?php if(isset($_SESSION['unotfound']) || isset($_SESSION['pincorrect'])) echo "block"; else echo "none"; ?>;">
            <div id="container-login">
                <p class="title">Login</p>
                <form id="loginform" action="logincheck.php" method="post">
                <div class="floating-label-grp
                        <?php if(isset($_SESSION['unotfound'])): ?> form-error <?php endif ?> "
                >
                        <label class="floating-label">Username:</label>
                        <input type="text" id="uname-login" name="uname-login"/>
                        <?php
                            if(isset($_SESSION['unotfound'])): ?>
                                <span><?php echo $_SESSION['unotfound'] ?></span>
                            <?php unset($_SESSION['unotfound']); endif;?>
                        
                     </div>
                     
                     <div class="floating-label-grp
                        <?php if(isset($_SESSION['pincorrect'])): ?> form-error <?php endif ?> "
                    >
                        <label class="floating-label">Password:</label>
                        <input type="password" id="password-login" name="password-login" />
                        <?php
                            if(isset($_SESSION['pincorrect'])): ?>
                                <span><?php echo $_SESSION['pincorrect'] ?></span>
                            <?php unset($_SESSION['pincorrect']); endif;?>
                    </div>
                    <div style="text-align: center;">
                    <input type="reset"  class="sub"/>
                    <input type="submit" style="margin-left: 10px;" class="sub" value="Enter"  />
                    </div>
                 </form>
                 </div>
        
        </div>
        <!--   Sign-up Form  -->
        <div id="parent-signin" style="display: 
        <?php if(isset($_SESSION['etaken']) || isset($_SESSION['utaken'])) echo "block"; else echo "none"; ?>;">
            <div id="container-signin">
                <p class="title">Create a New Account!</p>
                <form id="signupform" action="signincheck.php" method="post">
                    <div class="floating-label-grp
                        <?php if(isset($_SESSION['etaken'])): ?> form-error <?php endif ?> "
                    >
                        <label class="floating-label">Email ID:</label>
                        <input type="text" id="email" name="email" placeholder="Ex: tomcruise@gmail.com" class="form-control"/>
                        <?php
                            if(isset($_SESSION['etaken'])): ?>
                                <span><?php echo $_SESSION['etaken'] ?></span>
                            <?php unset($_SESSION['etaken']); endif;?>
                    </div>
                    <div class="floating-label-grp
                       <?php if(isset($_SESSION['utaken'])): ?> form-error <?php endif ?>"
                    >
                        <label class="floating-label">Username:</label>
                        <input type="text" id="uname-signin" name="uname-signin" placeholder="Ex: naruto1234" class="form-control"/>
                        <?php
                            if(isset($_SESSION['utaken'])): ?>
                                <span><?php echo $_SESSION['utaken'] ?></span>
                            <?php unset($_SESSION['utaken']); endif;?>
                        
                    </div>
                    <div class="floating-label-grp">
                        <label class="floating-label">Password:</label>
                        <input type="password" id="password-signin" name="password-signin" class="form-control"/>
                        
                    </div>
                    <div style="text-align: center;">
                    <input type="reset"  class="sub"/>
                    <input type="submit" style="margin-left: 5px;" class="sub" value="Create Account"  />
                    </div>
                </form>
            </div>
        </div>

    </body>
</html>
