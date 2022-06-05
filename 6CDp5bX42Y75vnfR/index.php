<?php
session_start();

if(isset($_COOKIE['token']) && isset($_SESSION['token'])){
    $token_cookie = $_COOKIE['token'];
    $token_session = $_SESSION['token'];
    
    if($token_cookie == $token_session){
        
        header('Location: /Admin_kam_maj_onglets/mise-a-jour');
    
    }else{
            header('Location: /');
    }
}else{
    header('Location: /');
}
?>