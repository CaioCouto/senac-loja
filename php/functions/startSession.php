<?php
$monthInSeconds = 30*24*60*60;
if (isset($_COOKIE[session_name()])){
    session_start();
    setcookie(
        name: session_name(), 
        value: session_id(), 
        domain: $_SERVER['SERVER_NAME'], 
        path: '/',
        // expires_or_options: time() + $monthInSeconds
    );
}