<style>
#grid-container{
    padding-left:25px ;
    display: grid;
    align-content: center; 
    grid-template-columns: auto auto auto;
    grid-template-rows: 90px;
}
#friend_profile_image{
            width:50px;
            height:50px;
            padding-top: 20px;
         
        }
#friends_btn{
    font-size:22px; 
    font-weight:bold;
    font-family:tahoma;
     text-decoration:none;
}
</style>
<?php
    //<!--  Friends  -->
    echo "<div id='friends_box' >";
                
       echo" <a href='login.php' id='friends_btn'>
            Friends";
        echo "</a>";
        echo "<div id='grid-container'>";

                
                    include ("classes/config1.php");



                    $req ="SELECT * FROM users ";
                    $req5="SELECT * FROM profile_pic";
                    $result2=$cnx->query($req5);    
                    $col2=$result2->fetch();
                    $result = $cnx->query($req);
                    if(!$result)
                    {
                        echo "echec de requete";
                        print_r($cnx->errorInfo());
                    }
                    while ( $col = $result->fetch() )
                    {
                        echo "<div class='grid-item'>";
                        if($col[8]!=""){
                            echo '<img id="friend_profile_image" src="data:image/jpeg;base64,' . $col[8] . '"/>';
                            echo "<br/>";
                            echo "<span>$col[3]</span>";   
                        }else{
                        if($col[7]!=""){
                            echo '<img id="friend_profile_image" src="data:image/jpeg;base64,' . base64_encode($col[7]) . '"/>';
                            echo "<br/>";
                            echo "<span>$col[3]</span>";
                        }else {

                           echo '<img id="friend_profile_image" src="data:image/jpeg;base64,' . base64_encode($col2[2]) . '"/>';
                           echo "<br/>";
                           echo "<span>$col[3]</span>";
                        }
                    }
                        echo "</div>";
                    }
                
                

            
        echo "</div>";
        
        echo "<div style='text-align: center;margin-top:35px ;font-size:25px;'>";
        echo "<a id='add_friends' href='profile.php'> Add more friends </a>";
        echo "</div>";

echo "</div>";
?>