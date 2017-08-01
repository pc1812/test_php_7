<?php

require_once __DIR__.'/../main/init.php';

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
$model->getData('select u.picture_url, p.post_content from users u, posts p where u.id=p.user_id order by p.id desc', [], function($data) {
	echo "<table>";
	foreach($data as $row) {
		echo "<tr>";
		echo "<td><img src='".$row['picture_url']."' width='54' height='54'/></td>";
		echo "<td><textarea read-only>".$row['post_content']."</textarea></td>";
		echo "</tr>";
	}
	echo "</table>";
});
die();
?>