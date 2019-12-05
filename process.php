<?php
    $conn = new mysqli("localhost","root","","crud");
    if($conn->connect_error){
        die("Connection failed" .$conn->connect_error);
}
// echo("Connection Sucessfull");

$result = array('error'=>false);
$action = '';

if(isset($_GET['action'])){
    $action = $_GET['action'];
}

if($action == 'read'){
    $sql = $conn->query("SELECT * from users");
    $users = array();
    while($row = $sql->fetch_assoc()){
        array_push($users,$row);
    }
    $result['users'] = $users;
}

if($action == 'create'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sql = $conn->query("INSERT INTO users (name,email,phone) values ('$name','$email','$phone')");
    if($sql){
        $result['message']= "user added succesfully";
    }
    else{
        $result['error'] = true;
        $result['message'] = "Failed to add user";
    }
    
}
   


if($action == 'update'){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    $sql = $conn->query("UPDATE users 
                            SET name='$name' ,email ='$email' ,phone = '$phone' 
                            where id = '$id'");
    if($sql){
        $result['message']= "user updated succesfully";
    }
    else{
        $result['error'] = true;
        $result['message'] = "Failed to update user";
    }
    
}



if($action == 'delete'){
    $id = $_POST['id'];
       
    $sql = $conn->query("DELETE from users  where id = '$id'");
    if($sql){
        $result['message']= "user deleted succesfully";
    }
    else{
        $result['error'] = true;
        $result['message'] = "Failed to delete user";
    }
    
}



$conn->close();
// $result['users'] = $users;


echo json_encode($result);

?>