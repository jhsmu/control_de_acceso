<?php 

 session_start();
 $_SESSION = array();
 if (ini_get("session.use_cookies") == true) {
 $parametros = session_get_cookie_params();
 setcookie(
 session_name(),
 '',
 time() - 99999,
 $parametros["path"],
 $parametros["domain"],
 $parametros["secure"],
 $parametros["httponly"]
 );
 }
 session_destroy();

 header("location:../index.php");