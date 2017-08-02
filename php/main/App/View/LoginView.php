<?php

namespace App\View;

use App\AbstractView;

class LoginView extends AbstractView {
	public function display($data) {
		?>
		<form action='login.php' method='post'>
		email:<input type='text' name='username'/><br>
		password:<input type='password' name='password'/><br>
		<input type='submit' value='login'/>
		<input type='button' value='new' onclick='location.href="register.php"'/>
		<input type='button' value='forget' onclick='location.href="reclaim.php"'/>
		
		</form>
		<?php
	}
}

?>