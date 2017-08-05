<?php
    
require_once __DIR__.'/../main/init.php';

use App\View\RegisterView;

if ($auth->isUser()) {
    header('Location: index.php');
}

if(!isset($_POST["nickname"]) || !isset($_POST["username"]) || !isset($_POST["password"])) {
    $view = new RegisterView();
    $view->display([]);
    die();
}


$nickname = htmlentities($_POST["nickname"]);
$username = htmlentities($_POST["username"]);
$password = htmlentities($_POST["password"]);

$id = $model->insertData(
    "insert into users (name, email, password, created_at, updated_at) values (:name, :email, password(:password), now(), now())",
    ['name'=>$nickname, 'email'=>$username, 'password'=>$password],
    function($lastId) {
        session_start();
        $_SESSION['id'] = $lastId;
        global $auth;
        $auth->validate();
        header('Location: index.php');
    }
);
?>