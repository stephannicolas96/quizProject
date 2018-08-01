<?php

include_once path::$classes . 'user.php';

$loginUserInstance = new user();

$loginSuccess = false;
$formError = array();

if (!empty($_POST) && isset($_POST['connect'])) {
    
    $loginError = true;
    
    //MAIL/USERNAME
    if (isset($_POST['login'])) {
      
        $login = htmlspecialchars($_POST['login']);
        $loginUserInstance->mail = $loginUserInstance->username = $login;
         
        if($loginUserInstance->getUserByMail() == 1 || $loginUserInstance->getUserByUsername() == 1){
           $loginError=false;
        }
    }

    //PASSWORD
    if (isset($_POST['password'])) {

        $loginUserInstance->password = htmlspecialchars($_POST['password']);

        if (!preg_match(regex::$password, $loginUserInstance->password) || empty($loginUserInstance->password)) {
            $loginError = true;
        }
    }
    
    if($loginError){
        $formError['connexion'] = 'Mail/Nom d\'utilisateur ou mot de passe incorrecte';
    }
    
    if(count($formError) == 0 && password_verify($loginUserInstance->password, $loginUserInstance->hashedPassword)){
        $_SESSION['username'] = $loginUserInstance->username;
        $_SESSION['mail'] = $loginUserInstance->mail;
        $_SESSION['image'] = $loginUserInstance->image;
        $_SESSION['color'] = $loginUserInstance->color;
        $_SESSION['id'] = $loginUserInstance->id;
        $_SESSION['logged'] = true;
        $loginSuccess = true;
        unset($_POST);
    }
}
