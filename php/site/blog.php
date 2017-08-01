<?php
require_once __DIR__.'/../main/init.php';

use App\View\BlogView;

if ($auth->isGuest()) {
    header('Location: login.php');
    die();
}

if(!isset($_POST["content"])) {
    $view = new BlogView();
    $view->display([]);
    die();
}
    
$content = $_POST["content"];

$model->insertData(
    "insert into posts (user_id, replee_id, post_content, created_at, updated_at) values (:id, 0, :content, now(), now())",
    ['id'=>$auth->getProfile('id'), 'content'=>$content],
    function($lastId) {
        header('Location: index.php');
    }
);
