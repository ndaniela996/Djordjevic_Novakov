<?php
    session_start();

//    if(isset($_SESSION['id_user']))
//    {
//        $_SESSION['id_user']='';
//    }
//    if(isset($_SESSION['admin']))
//    {
//        $_SESSION['admin']='';
//    }
//    if(isset($_SESSION['username']))
//    {
//        $_SESSION['username']='';
//    }
//    if(isset($_SESSION['logged_in']))
//    {
//        $_SESSION['logged_in']='';
//    }

    session_unset();

    session_destroy();
