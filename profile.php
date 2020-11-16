<?php
    error_reporting(-1);
    ini_set('display_errors', 'On');
    session_start();
    include('classes/login.php');
    include('classes/config.php');

    include('classes/config1.php');
    include('classes/user.php');
    include('classes/post.php');

    //check if user is connecter
    if(isset($_SESSION['besocial_user_id']) && is_numeric($_SESSION['besocial_user_id'])){
        $id=$_SESSION['besocial_user_id'];
        $login = new Login();
        $result = $login->check_login($id);
        if($result){
            //Retriving data..
            $user=new User();
            $user_data=$user->getdata($id);
            if(!$user_data){
                header("Location: login.php");
                die;
            }
        }else{
            header("Location: login.php");
            die;
        }
    }else {
        header("Location: login.php");
            die;
    }
//echo "<pre>";
//print_r($user_data);
//echo "</pre>";
    
?>


<!------------------------------------------------------------------------------------------------------>
<!------------------------------------------- HTML PART ------------------------------------------------>
<!------------------------------------------------------------------------------------------------------>



<html>
    <head>
        <title>BeSocial | Profile</title>
        <link rel="stylesheet" href="css/profile_css.css">

    </head>


    <body style="font-family:tahoma; background-color:#e9ebee;">
        <!-- TOP BAR -->
        <div id="header_profile">
            <div id="nav_bar" >
            <div class="buttons">
                
                <span id="header_BeSocial_id" >BeSocial</span> 
                <input  type="text" id="search_field" placeholder="Type to search..">
                
                    <a href="logout.php" name="LOGOUT" id="logout">Disconnect</a>
                    
                    <a class="active" href="profile.php">Profile</a>
                    <a  href="signup.php">Home</a>
                </div>

            </div>
        </div>
        <br>
        <!-- COVER AREA -->
        <div style="width:90%; margin:auto; min-height:100%;">
        
            <div style="text-align:center;">
                <img src="cover-image.JPG" style="width:100%; height:500px;"></img> 
                
                <?php
                $req0="SELECT * FROM users WHERE user_id=$id";
                $result = $cnx->query($req0);

                $col = $result->fetch();
                $req5="SELECT * FROM profile_pic";
                $result2=$cnx->query($req5);
                $col0=$result2->fetch(); 
                if($col[7]==""){
                echo '<img class="sh-img" id="profile_pic" src="data:image/jpeg;base64,' . base64_encode($col0[2]) . '"/>';
                }else 
                echo '<img class="sh-img" id="profile_pic" src="data:image/jpeg;base64,' . base64_encode($col[7]) . '"/>';
                ?>
                 
                <h3 style="font-family:tahoma; font-size:24px; margin-top:-35px; 
                color:white;background-color:black"><?php echo $user_data['first_name']
                             . " ". $user_data['last_name']; ?></h3>

                
                
            </div>

            <!-- Change profile pic buttons -->
            <div id="change_buttons">
                    <a href="upload_profile_pic.php" style="color:#d9dfeb;text-decoration:none;">Change profile image</a>
                       <b style="color:white;">-</b>
                    <a href="profile.php" style="color:#d9dfeb;text-decoration:none;">Change cover</a>
            </div>
            <div style="display:flex;">

            <!--  Friend list and share box  -->
            <?php include("user.php"); ?>

            
                <!--  Posts  -->
                <div id="post_box">
                    <!-- Writing Posts  -->
                    <form method="post" enctype="multipart/form-data" action="profile.php" 
                        style="border:solid thin grey;padding:10px;background-color:white;">
                        
                        <textarea rows="5" name="text" placeholder="What's on your mind?"></textarea>
                        <input type="hidden" name="size" file="99000000">
                        <input id="button_choose_image" type="file" name="file" size=50 value="open file" > 

                        <input id="button_post" type="submit" name="button_post" value="POST" >  <br> <br>
                        <?php
                            $post=new Post(); 
                            $id=$_SESSION['besocial_user_id'];

                            $result=$post->upload_img($id,$_POST);

                            if(isset($_POST['button_post'])){

                            if($result==''){
                                header("Location: profile.php");
                                die;
                            }
                        }
                            
                        ?>
                    </form>

                    <!---HERE ARE THE POSTS---->
                    <?php
                    
                    include('post.php');
                    
                    
                    ?>
                    


                </div>
            </div>
        </div>

    </body>

</html>