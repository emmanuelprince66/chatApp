<?php
session_start();
require_once "auth.php";
$cuser = new Auth();



if (isset($_SESSION['user'])) {
    $cemail = $_SESSION['user'];
    $data = $cuser->currentUser($cemail);

    $cid = $data['id'];
    $cname = $data['name'];
    $cpass = $data['password'];
    $created = $data['created_at'];
    $reg_on = date('d M Y', strtotime($created));
    $cgender = $data['gender'];
    $cdob =  $data['dob'];
    $cphoto = $data['photo'];
    $cdob = $data['dob'];
    $cdes = $data['descript'];
    $cphone = $data['phone'];
    $cnoti = $data['notification'];
    $cpid = $data['pid'];
    $csid = $data['sid'];



    $fname = strtok($cname, " ");
} else {
}