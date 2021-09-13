<?php
require 'config.php';
require 'models/Auth.php';

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');
$brithdate = filter_input(INPUT_POST, 'brithdate');

if($name && $email && $password && $brithdate) {

    $auth = new Auth($pdo, $base);

    $brithdate = explode('/', $brithdate);
    if(count($brithdate) != 3) {
        $_SESSION['flash'] = 'Data de nascimento invalida';
        header("Location: ".$base."/signup.php");
        exit;
    }

    $brithdate = $brithdate[2].'-'.$brithdate[1].'-'.$brithdate[0];
    if(strtotime($brithdate) === false) {
        $_SESSION['flash'] = 'Data de nascimento invalida';
        header("Location: ".$base."/signup.php");
        exit;
    }

    if($auth->emailExists($email) === false) {

        $auth->registerUser($name, $email, $password, $brithdate);
        header("Location: ".$base);
        exit;

    } else {
        $_SESSION['flash'] = 'E-mail já cadastrado';
        header("Location: ".$base."/signup.php");
        exit;
    }

} 

$_SESSION['flash'] = 'Campos não enviados';
header("Location: ".$base."/signup.php");
exit;