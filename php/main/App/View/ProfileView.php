<?php

namespace App\View;

use App\AbstractView;

class ProfileView extends AbstractView {
	public function display($pdoStmt) {
		?>
		<img src='<?=$data['picture_url']?>' width='100' height='100'/><br>
		<form action="profile.php" method="post" enctype="multipart/form-data">
		<input type="file" name="pictures[]" /><br>
		name:<input type='text' name='nickname' value='<?=$data['name']?>'/><br>
		password:<input type='password' name='password'/><br>
		<input type='submit' value='update'/>
		<input type='button' value='back' onclick='location.href="index.php"'/>
		</form>
		<?php
	}
}

?>