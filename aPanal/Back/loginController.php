<?php
session_start();
include('../Back/contDb.php');

class loginController{
    function index($request){
        global $cont;
        $index = $cont->prepare("SELECT * FROM users WHERE email = ?");
        $index->execute([$request]);
        return $index;
    }
}
$users =new loginController();
if(isset($_POST['login'])){
    $email =trim( $_POST['email']);
    $password = $_POST['password'] ;

    $errors = [];
    if(empty($email)){
        $errors[] = "email can not be empty";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "email is not valid";
    }
    elseif(strlen($email)>250){
        $errors[] = "email must be at most 250 characters";
    }
    if(empty($password)){
        $errors[] = "passwoed can not be empty";
    }
    elseif(strlen($password)>250){
        $errors[] = "passwoed must be at most 250 characters";
    }
    if(empty($errors)){
        $result = $users->index($email)->fetch();
       print_r($result);
        
       
        if(!empty($result) ){

            $is_login = password_verify($password , $result['password']);
            
            if($is_login){
                $_SESSION['isLogin']=true;
                $_SESSION['userId'] = $result["id"];
                 header("Location:../home");
            }
            else{
                
                $errors[] = "password is not correct";
                header("location: ../login/viewLogin.php");
            }
        }
        else{
            header("location: ../login/viewLogin.php");
            $errors []= "email is not founde ";
        }
    }
    else{
        
        
        header("location: ../login/viewLogin.php");
    }
    $_SESSION['errors']=$errors;
    
}
