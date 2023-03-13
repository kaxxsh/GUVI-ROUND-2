<?php  
require 'vendor/autoload.php';  
// print_r($_POST);
// Creating Connection  
$serverApi = new \MongoDB\Driver\ServerApi(\MongoDB\Driver\ServerApi::V1);
$client = new \MongoDB\Client(
    'mongodb+srv://bharath18117886:1811786%40Csc@cluster0.zlt4eza.mongodb.net/test', [], ['serverApi' => $serverApi]);

$db = $client->login;
// Creating Document  
$collection = $db->students;  
// Insering Record  

// $collection->insertOne( [ 'name' =>'Peter', 'email' =>'peter@abc.com' ] );  
// Fetching Record  


if(isset($_POST['action'])&&$_POST['action']=='profileUpdate'){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $age  = $_POST['age'];
   
    echo $age;
    $updateResult  =  $collection->updateOne(
        ['email'=>$email],
        ['$set'=>['name'=>$name]],
       
    );
    
}else{

    $useremail =  $_GET['email'];
    $record = $collection->find( [ 'email' =>$useremail] );  

    foreach ($record as $employe) {  
        $userData = array("name"=>$employe['name'],"email"=> $employe['email'],"age"=>$employe['age']); 
    echo json_encode($userData);
    }  
    
}


function check_input($data){ //prevent attack from sql injection
    $data = trim($data);  //to trim the white spaces 
    $data = stripslashes($data); // to strip slashes
    $data = htmlspecialchars($data); // converts predefined characters to html entites
   
    return $data;
}
?>