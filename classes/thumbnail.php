<?php 
    include('config.php');

    include('config1.php');
    function create_thumbnail($image){
    error_reporting(-1);
    ini_set('display_errors', 'On');
    $data = 'iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABl'
    . 'BMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDr'
    . 'EX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r'
    . '8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==';
$data = base64_encode($image);
$im = imagecreatefromstring($image);
    if ($im !== false) {
     header('Content-Type: image/jpeg');
               //echo "<img src='  '/>";
  
     //   return $im;
echo '<img src=" imagecreatefromstring($image) "/>';

    }
    else {
        echo 'An error occurred.';
    }
    
    }    


    $req0="SELECT * FROM users";
    $result = $cnx->query($req0);

    $col = $result->fetch();
    $req5="SELECT * FROM profile_pic";
    $result2=$cnx->query($req5);
    $col0=$result2->fetch(); 
    if($col[7]==""){
        $col0[2]=create_thumbnail($col0[2]);

    echo '<img class="sh-img" id="profile_pic" src="data:image/jpeg;base64,' . base64_encode($col0[2]) . '"/>';
    }else {
        $colu=create_thumbnail($col0[2]);
    

    //echo '<img class="sh-img" id="profile_pic" src="data:image/jpeg;base64,' . $colu . '"/>';
    //echo $colu;

    }


?>