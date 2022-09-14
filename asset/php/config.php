<?php 

  class Database {

    
    private $dsn = "mysql:host=localhost;dbname=db_chat_users";
    private $dbuser = "root";
    private $dbpass = "";

    public $conn;

    public function __construct()
    {
      try {
        $this->conn = new PDO ($this->dsn , $this->dbuser , $this->dbpass);
      }catch(PDOException $e) {
         echo ' Error :'.$e->getMessage();
      }
      return $this->conn;
    }

    //check input
     public function test_input($data) {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);

       return $data;
     }
     //Error Sucess message Alert
     public function showMessage ($type , $message) {
       return '<div class=" alert alert-'.$type.' alert-dismissible">
                 <button type="button class = "close" data-dismiss="alert">&times;</button>
                 <strong class="text-center">'.$message.'</strong>
              </div>';
     }

     //diplay errors
      public function displayError() {
           ini_set('display_errors', 'off');
           error_reporting(E_ALL);
     }
     //random string generator

     public function randomString($n) {
         $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
         $str = '';
         for($i = 0 ; $i < $n; $i++) {
             $index = rand(0 ,strlen($characters)-1);
             $str .=$characters[$index];
         }
         return $str;
     }
  }
 









?>