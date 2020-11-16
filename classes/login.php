<?php
    class Login{
        private $error="";


        public function evaluate($data){
             $email=addslashes($data['email']);
             $password=addslashes($data['password']);
            
            $query="SELECT * FROM users WHERE email = '$email' limit 1;";
            
            
            $mydb=new Database();   
            $result=$mydb->read($query);
            if($result){
                $row=$result[0];
                if(empty($row['email'])){
                    $this->error=$this->error . "No such email was found, please register!";
                    return $this->error;
                
                }
                if($password==$row['password']){
                    //CREATE USER SESSION
                    $_SESSION['besocial_user_id']=$row['user_id'];


                }else 
                    return $this->error=$this->error . "Wrong password! <br/>";
            } 
        }

        public function check_login($id){
            $query="SELECT user_id FROM users WHERE user_id = '$id' limit 1;";
            
            
            $mydb=new Database();   
            $result=$mydb->read($query);
            if($result){
                return true;
            }else 
                return false;
        }


    }
?>