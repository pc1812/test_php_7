<?php

namespace App\View;

use App\AbstractView;

class BlogView extends AbstractView {
	public function display($data) {
		?>
		<form action='blog.php' method='post'>
		Content:<input type='text' name='content'/><br>
		<input type='submit' value='send'/>
		</form>
		<?php
	}
}

?>