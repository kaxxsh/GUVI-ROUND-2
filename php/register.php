<?php
// print_r($_POST);

$dbhost= "127.0.0.1";
// $dbhost = "localhost";
$dbuser = "root";
$dbpass = '';
$dbname = "login_system";

$conn = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
// echo $conn;
require 'vendor/autoload.php';  
// Creating Connection  
$serverApi = new \MongoDB\Driver\ServerApi(\MongoDB\Driver\ServerApi::V1);
$client = new \MongoDB\Client(
    'mongodb+srv://bharath18117886:1811786%40Csc@cluster0.zlt4eza.mongodb.net/test', [], ['serverApi' => $serverApi]);
$db = $client->login;
$collection = $db->students;  

if(isset($_POST['action'])&&$_POST['action']=='register'){
  $name = check_input($_POST['name']);
  $uname = check_input($_POST['uname']) ;
  $email = check_input($_POST['email']);
  $pass = check_input($_POST['pass']);
  $cpass = check_input($_POST['cpass']);
  $pass = sha1($pass);
  $cpass  = sha1($cpass);
  $created = date('Y-m-d');
  if($pass!=$cpass){
    echo "password did not matched !";
    exit();
  }else{
    // sql  prepared statement 
    $sql = $conn->prepare("SELECT username,email from users WHERE username =? OR email=?");
    $sql->bind_param("ss",$uname,$email);
    $sql->execute();
    $result = $sql->get_result();
    $row  = $result->fetch_array(MYSQLI_ASSOC);
    // echo $uname;
    // echo $row['username'];
    if(isset($row['username'])== $uname)
    {
        echo 'username not available try different';

    }else if(isset($row['email']) == $email)
    {
        echo 'email is already registered try different ';
    }
    else
    {
        $stmt = $conn->prepare("INSERT INTO users (name,username,email,pass,created) VALUES (?,?,?,?,?)");
        $stmt->bind_param('sssss',$name,$uname,$email,$pass,$created);

        // echo $stmt->is_executable();
        if($stmt->execute()){
            echo "registerd sucessfully . Login now!";
// Creating Document  

// Insering Record  
          $collection->insertOne( [ 'name' =>$name, 'email' =>$email,'age'=>'','phoneno'=>" ",'address'=>" ",'bio'=>"",'city'=>"","codep"=>""] );  

            echo "<script> location.href='http://localhost:3000/login.html'; </script>";
            exit;
            // exit();
        }else{
            echo "some thing went wrong. please again !";
        }
    }

  }


}else{
  session_destroy(); 
  // echo session_status();
  // header('location:login.html');
}


function check_input($data){ //prevent attack from sql injection
    $data = trim($data);  //to trim the white spaces 
    $data = stripslashes($data); // to strip slashes
    $data = htmlspecialchars($data); // converts predefined characters to html entites
   
    return $data;
}
// echo 'success';


?>