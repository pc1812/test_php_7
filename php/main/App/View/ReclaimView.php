<?php

namespace App\View;

use App\AbstractView;

class ReclaimView extends AbstractView {
	public function display($data) {
		?>
		<form action='reclaim.php' method='post'>
		email:<input type='text' name='username'/><br>
		<input type='submit' value='reclaim'/>
		<input type='button' value='back' onclick='location.href="index.php"'/>
		
		</form>
		<?php
	}
}

?>