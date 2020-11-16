<?php
    class Signup{
        private $error="";

         function evaluate($data){
            foreach ($data as $key => $value) {
                if(empty($value)){
                    $this->error=$this->error . $key . " is empty!<br/>";
                }
            }
            if($data['password']!=$data['re_password'])
                $this->error=$this->error . " Passwords don't match";
            
            if($this->error==""){

                //no error
                $this->create_user($data);
            }else return $this->error;
        }

        public function create_user($data){
             $user_id=$this->create_userid();
             $first_name=ucwords($data['first_name']);
             $last_name=ucwords($data['last_name']);
             $email=$data['email'];
             $password=$data['password'];
             $url_address= str_replace(' ', '', strtolower($first_name)) . "." . strtolower($last_name);
            
            $query="INSERT INTO users (user_id,first_name,last_name,email,password,url_address)
            VALUES ('$user_id','$first_name','$last_name','$email','$password','$url_address');";
            
            
            $mydb=new Database();   
            $mydb->save($query);
        }


        private function create_userid(){
            $len = rand(4,19);
            $number="";
            for ($i=1; $i < $len ; $i++) { 
                $new_rand=rand(0,9);
                $number = $number . $new_rand;
            }
            return $number;
        }

    }
?>