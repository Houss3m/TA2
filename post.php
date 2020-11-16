 <!--  Posts  View-->
 <link rel="stylesheet" href="css/profile_css.css">

 <div id="post_bar">
                    
                    <!-- Single post -->
                        
                        
                        
                        <!--- text post --->
                        <?php
                                    error_reporting(-1);
                                    ini_set('display_errors', 'On');
                                    $id=$_SESSION['besocial_user_id'];

                                    include ("classes/config1.php");

        $req = "SELECT * FROM (
            
            (SELECT images.img_id, NULL AS text_id, NULL AS text, 
            images.img_nom, images.img_blob, images.date, images.img_type ,images.img_taille
            ,images.img_text FROM images WHERE user_id=$id)

            UNION ALL

            (SELECT NULL AS img_id, texts.post_id, texts.text, NULL AS img_nom, NULL AS img_blob,
            texts.date, NULL AS img_type, NULL AS img_taille, NULL AS img_text FROM texts WHERE user_id=$id)
        
        ) results 
        
        ORDER BY date DESC";

                                    $result = $cnx->query($req);
                                    if(!$result)
                                    {
                                    echo "echec de requete";
                                    print_r($cnx->errorInfo());
                                    }
                                    while ( $col = $result->fetch() )
                                    {

                                       echo '<div id="post">';
                                       echo '<div>';
                                       $req1="SELECT * FROM users WHERE user_id=$id";

                                       $result1 = $cnx->query($req1);
                           

                $req5="SELECT * FROM profile_pic";
                $result2=$cnx->query($req5);
                $col0=$result2->fetch(); 

                $col2 = $result1->fetch();
                if($col2[7]==""){
                echo '<img class="sh-img" id="post_profile_image" src="data:image/jpeg;base64,' . base64_encode($col0[2]) . '"/>';
                }else 
                //echo "<img src='data:image/jpeg;base64,";
                echo '<img class="sh-img" id="post_profile_image" src="data:image/jpeg;base64,' . base64_encode($col2[7]) . '"/>';
               
                           
               //                        echo '<img class="sh-img" id="post_profile_image" src="data:image/jpeg;base64,' . base64_encode($col2[7]) . '"/>';

                                       echo '</div>';            
                                        echo  '<div id="post_text">';
                                        echo '<span id="post_profile_name">Houssam Lachemat</span> <br/>';


                                        //echo "<h5>  $col[0]" ."<br> </h5>";
                                        if($col[4]!=''){
                                        echo "$col[5] "."</br>";
                                        echo "<h5>  $col[8]" ."</h5><br/>";
                                        echo '<img style="width:100%;" class="sh-img" src="data:image/jpeg;base64,' . 
                                        base64_encode($col[4]) . '"/>';
                                        }else {
                                            echo "$col[5] "."</br>";
                                            echo "<h5>  $col[2]" ."</h5><br/>";
                                        }
                                        echo '</div>';
                                        echo '</div>';            
                                    }
                                    ?>

                        
                        

                    </div>
