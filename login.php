<?php
    session_start();
    include('classes/login.php');
    include('classes/config.php');
    $email="";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $login = new Login();
        $result=$login->evaluate($_POST);
        
        if($result!=""){
            echo "<div style='text-align: center;font-size: 12px;background-color: darkred;color: white;'>";
            echo "The following errors occured: <br/><br>";
            echo $result;
            echo "</div>";
        } else{
            header("Location: profile.php");
            die;
        }
        $email=$_POST['email'];
        //echo "<pre>";
        //print_r($_POST);
        //echo "</pre>";
    }
?>


<html>
    <head>

        <title> BeSocial | Log in</title>
    <link rel="stylesheet" href="css/login_css.css">
    </head>

    <body style="font-family:tahoma; background-color:#e9ebee;">
        
        <div id="header" >
            <span id="header_BeSocial">BeSocial</span>
            <span >
                <a id="header_signup_button" href="signup.php">
                    Sign Up
                </a>
            </span>
        </div>

        <form id="login_form" method="POST">


            <div style="height:50px; font-size:23px;">
                <b>Log in to BeSocial</b>
            </div><br> 

            <input value="<?php echo $email ?>" type="email" placeholder="email adress" id="account_id" name="email"> <br><br>
            <input type="password" placeholder="password" id="password" name="password"> <br><br>
            <input type="submit" id="login_button" name="LOGIN" value="LOG IN"> <br>
            <a href="signup.php">Don't have an account</a><br>
            <a href="google.com">forget password</a>
        </form>
        

    </body>

</html>