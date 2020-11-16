<?php 
    class Post{
        function upload_img($user_id,$data){
            $img_blob = '';
            $img_taille = 0;
            $img_type = '';
            $img_text="";
            $img_nom = '';
            $taille_max = 999999;
            
            if(isset($data['button_post'])){
                $ret = is_uploaded_file($_FILES['file']['tmp_name']);
                if (!$ret) {
                    $this->upload_text($user_id,$data);
                    //call upload text..
                    return false;}
                else {

                    // Le fichier a bien �t� re�u
                    $img_taille = $_FILES['file']['size'];

                    if ($img_taille > $taille_max) {
                        echo "Trop gros ! le fichier doit etre < 1MO";
                        return false;
                    }
            
                    $img_type = $_FILES['file']['type'];
                    $img_nom = $_FILES['file']['name'];
                    $img_text=$data['text'];
                    $img_blob = file_get_contents ($_FILES['file']['tmp_name']);
                    echo $img_nom." est bien trasf�r�";
                    echo "<br/> <br/> " . $img_text;

            }

                /***************************************************/
            $img_id=$this->create_postid();
            $db1=new Database();

    $req = "INSERT INTO images 
    (img_id,user_id,img_nom,img_taille,img_type,img_blob,img_text) 
    VALUES ('$img_id','$user_id','$img_nom','$img_taille','$img_type',"."'".addslashes($img_blob)."','$img_text');";
     
               $cnx=$db1->connect();
                
                if($cnx){
                    $ret2=$db1->save($req);
                    if($ret2) 
                        echo "<h2>Insertion avec success</h2>";
                    else{
                        echo "<h2>Echec</h2>";
                        print_r($cnx->errorInfo());
                        }
                    return true;
                }
                else
                    die ("<h3>Die, error on connexion on config.php</h3>");
            
            }
        }




        // ************************** UPLOAD TEXT METHOD ************************
        function upload_text($user_id,$data){
            $ret = false;
            $text = '';
            
            if(isset($_POST['button_post'])){
                $ret = is_uploaded_file($_FILES['file']['tmp_name']);

                if ($_POST['text']=='') {
                    echo "please type something..";
                    return false;}
                else {
                    // Le statut a bien reçu
                    $text = $_POST['text'];

                    echo " post accepted";
            }

                /***************************************/
                $db2=new Database();
                $post_id=$this->create_postid();
                $req3 = "INSERT INTO texts (post_id,user_id,text) VALUES ('$post_id','$user_id','$text');";

                $cnx=$db2->connect();                

                if($cnx){
                    $ret=$db2->save($req3);
                    
                    if($ret) {
                        echo "<h2>Status bien posté</h2>";}
                    else{
                        echo "<h2>Echec</h2>";
                        echo "<pre>";
                        print_r($cnx->errorInfo());
                        echo "</pre>";
                        }
                    return true;
                }
                else
                    die ("<h3>Die, error on connexion on config.php</h3>");
            
            }
        }
    
        public function get_posts($id){
            $db2=new Database();
            $post_id=$this->create_postid();
            $req = "SELECT * FROM (
            
                (SELECT images.id, images.img_id, NULL AS post_id,images.user_id, NULL AS text, 
                images.img_nom, images.img_blob, images.img_date, images.img_type ,images.img_taille
                ,images.img_text FROM images)
    
                UNION ALL
    
                (SELECT texts.id,NULL AS img_id, texts.post_id,texts.user_id, texts.text, NULL AS img_nom,
                 NULL AS img_blob,
                texts.text_date, NULL AS img_type, NULL AS img_taille, NULL AS img_text FROM texts)
            
            ) results WHERE user_id=$id
            
            ORDER BY img_date DESC";

            $req1="SELECT * FROM texts WHERE user_id = $id";
            $cnx=$db2->connect();                
            if($cnx){
                echo "inside cnx";
                $result=$db2->read($req1);
                
                if($result){

                    echo "    no  error     ";


                    
                return $result;
                }else
                 return false;
            }
        }

        private function create_postid(){
            $len = rand(4,19);
            $post_id="";
            for ($i=1; $i < $len ; $i++) { 
                $new_rand=rand(0,9);
                $post_id = $post_id . $new_rand;
            }
            return $post_id;
        }
        

    }
?>