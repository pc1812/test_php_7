<?php

require_once __DIR__.'/../main/init.php';

use App\View\IndexView;

if ($auth->isUser()) {
	echo "Hello, ".$auth->getProfile('name');
	echo "<br><a href='logout.php'>Logout</a>";
	echo "<br><a href='profile.php'>Profile</a>";
	echo "<br><a href='blog.php'>Blog</a>";
}
else {
	echo "<a href='login.php'>Login</a>";
}
?>

<?php
$view = new IndexView();

$model->getData(
	'select u.picture_url, u.name, p.post_content from users u, posts p where u.id=p.user_id order by p.id desc', 
	[], 
	['picture_url', 'name', 'post_content'], 
	$view
	);

die();
?>