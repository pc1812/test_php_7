<?php
    
require_once __DIR__.'/../main/init.php';

use App\View\LoginView;

if ($auth->isUser()) {
    header('Location: index.php');
}


if(!isset($_POST["username"]) || !isset($_POST["password"])) {
    $view = new LoginView();
    $view->display([]);
    die();
}
    
$username = $_POST["username"];
$password = $_POST["password"];

$model->getData(
    "select id from users where email=:username and password=password(:password)",
    ['username'=>$username, 'password'=>$password],
    ['id'],
    function($data) {
        if (count($data) == 1) {
            //pass
            $row = $data[0];
            $_SESSION['id'] = $row['id'];
            error_log('session '.$row['id'], 0);
            global $auth;
            $auth->validate();
            header('Location: index.php');
        }
        else {
            
            die();
        }
    }
    );
?>