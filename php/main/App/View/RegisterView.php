<?php

namespace App\View;

use App\AbstractView;

class RegisterView extends AbstractView {
	public function display($data) {
		?>
		<form action='register.php' method='post'>
		name:<input type='text' name='nickname'/><br>
		email:<input type='text' name='username'/><br>
		password:<input type='password' name='password'/><br>
		<input type='submit' value='register'/>
		
		</form>
		<?php
	}
}

?>