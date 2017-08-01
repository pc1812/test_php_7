<?php
    
require_once __DIR__.'/../main/init.php';

use App\View\ReclaimView;
use App\Mail;

if(!isset($_POST["username"])) {
    $view = new ReclaimView();
    $view->display([]);
    die();
}
    
$username = $_POST["username"];

Mail::mailto();

$model->getData(
    "select id from users where email=:username and password=password(:password)",
    ['username'=>$username, 'password'=>$password],
    function ($data) {
        if ($data->rowCount() == 1) {
            //pass
            $row = $data->fetch();
            $_SESSION['id'] = $row['id'];
            error_log('session '.$row['id'], 0);
            global $auth;
            $auth->validate();
            header('Location: index.php');
        }
        else {
            unset($_POST["password"]);
            $data = ['username'=>$username];
            $view = new LoginView();
            $view->display($data);
            die();
        }
    });
?>