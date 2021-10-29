<?php
date_default_timezone_set("America/Sao_Paulo");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $location = !empty($_GET) ? '/?deleteSuccess=true' : '/';
    setcookie(session_name(), NULL, time()-3600, '/');    
    header('Location: ' . $location);
}
else {
    header("Location: /pages/updateUser.php?invalidMethod=true");
}