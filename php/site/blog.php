<?php
require_once __DIR__.'/../main/init.php';

use App\View\BlogView;

if ($auth->isGuest()) {
    header('Location: login.php');
    die();
}

if(!$request->hasPost("content")) {
    $view = new BlogView();
    $view->display([]);
    die();
}
    
$content = $request->post["content"];

$model->insertData(
    "insert into posts (user_id, replyee_id, post_content, created_at, updated_at) values (:id, 0, :content, now(), now())",
    ['id'=>$auth->getProfile('id'), 'content'=>$content],
    function($lastId) {
        header('Location: index.php');
    }
);
