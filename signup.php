<?php
    include('classes/signup.php');
    include('classes/config.php');
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $signup = new Signup();
        $result=$signup->evaluate($_POST);
        
        if($result!=""){
            echo "<div style='text-align: center;font-size: 12px;background-color: darkred;color: white;'>";
            echo "The following errors occured: <br/><br>";
            echo $result;
            echo "</div>";
        } else{
            header("Location: login.php");
            die;
        }
        
        //echo "<pre>";
        //print_r($_POST);
        //echo "</pre>";
    }
?>






<html>
    <head>

        <title> BeSocial | Sign up</title>
<link href="css/signup_css.css" rel="stylesheet">
    </head>

 
    <body style="font-family:tahoma; background-color:#e9ebee;">
        
        <div id="header" >
            <span id="header_BeSocial">BeSocial</span>
            <span id="header_signup_button">
                <a id="header_signup_button" href="login.php">
                    Log in
                </a>
            </span>
        </div>




        <form id="login_form" method="POST" action="">
            
            <input type="text" placeholder="First name" id="name_id" name="first_name"> <br><br>
            <input type="text" placeholder="Last name" id="second_name_id" name="last_name"> <br><br>
            <input type="email" placeholder="email adress" id="account_id" name="email"> <br><br>
            <input type="password" placeholder="password" id="password" name="password"> <br><br>
            <input type="password" placeholder="repeat password" id="password" name="re_password"> <br><br>

            <input type="submit" name="SIGN_UP" id="signup_button" value="SIGN UP"> <br>
            <a href="login.php">You have an account</a><br>
            
        </form>


    </body>

</html>