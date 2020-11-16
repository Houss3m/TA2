<html>
<head>
<title>Change profile pic | BeSocial</title>
<link rel="stylesheet" href="css/upload_profile_pic.css">

</head>


<body>

        <!-- TOP BAR -->
        <div id="header_profile">
            <div id="nav_bar" >
            <div class="buttons">
                
                <span id="header_BeSocial_id" >BeSocial</span> 
                
                    <a href="logout.php">Disconnect</a>
                    <a href="profile.php">Profile</a>
                </div>

            </div>
        </div>
        <br>


<h3>Upload profile image (size < 1 MO)</h3>
<form enctype="multipart/form-data" method="post">
<input type="hidden" name="max_allowed_packet" value="1000000" />
<input type="file" name="file" size=500 />
<input type="submit" name="change"value="Envoyer" />
<br><br><br><br><br><br>
<!--<a style="font-size:25px;font-family:Tahoma; padding:25px;" href="profile.php"> GO BACK TO MY PROFILE</a>
-->
<?php
session_start();
include('classes/login.php');
include('classes/config.php');
include("classes/friends_thumb.php");
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
            //okay
            
        }else{
            header("Location: login.php");
            die;
        }
    }else {
        header("Location: login.php");
            die;
    }


error_reporting(-1);
    ini_set('display_errors', 'On');
    function upload_img(){
        $ret = false;
        $img_blob = '';
        $img_nom = '';
        $taille_max = 1000000;
        $img_taille=0;
        if(isset($_POST['change'])){
            $ret = is_uploaded_file($_FILES['file']['tmp_name']);
           // echo $_FILES['file']['tmp_name'];
            if (!$ret) {
                echo "probleme de transfert";
                //call upload text..
                return false;}
            else {
                // Le fichier a bien �t� re�u
                $img_taille = $_FILES['file']['size'];

                if ($img_taille > $taille_max) {
                    echo "Trop gros !";
                    return false;
                }

                $img_nom = $_FILES['file']['name'];
                $img_blob = file_get_contents ($_FILES['file']['tmp_name']);
                echo $img_nom." est bien trasf�r�";
        }
/***************************************/
$cnx=new Database();
 $profile_pic=$img_blob;
 if($cnx){
     $id=$_SESSION['besocial_user_id'];

    //Création du vignette..
    $thumbnail=new Thumbnail();
    $thumb_img=$thumbnail->create_thumbnail($_FILES['file']['tmp_name']);

     $req0="SELECT * FROM users WHERE user_id=$id";
     $result=$cnx->save($req0);    
     
     $col = $result->fetch();

     if($col[7]==""){
         $query="UPDATE users SET pp_thumb ='" . addslashes ($thumb_img) . "' WHERE user_id=$id";
         
         $req="UPDATE users SET profile_pic ='" . addslashes ($profile_pic) . "' WHERE user_id=$id";  
         $ret = $cnx->save($req);
         $ret = $cnx->save($query);


     } else{
        $query="UPDATE users SET pp_thumb ='" . addslashes ($thumb_img) . "' WHERE user_id=$id";
        $ret = $cnx->save($query);

        $req2="UPDATE users SET profile_pic ='" . addslashes ($profile_pic) . "' WHERE user_id=$id";         
          $ret = $cnx->save($req2);
 
        }
     
     if($ret) 
         echo "<h2>Insertion avec success</h2>";
     else{
         echo "<h2>Echec</h2>";
   
     }
     return true;
 }
 else
     die ("<h3>Die, error on connexion on config.php</h3>");

}
    }
    
    upload_img();
?>

</form>
</body>
</html>