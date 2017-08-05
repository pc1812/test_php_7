<?php

namespace App\View;

use App\AbstractView;

class IndexView extends AbstractView {
	
	public function display($data) {
		?>
		<table>
		<?php foreach($data as $row) {?>
			<tr>
			<td><img src='<?=$row['picture_url']?>' width='54' height='54'/></td>
			<td><?=$row['name']?><br><textarea read-only><?=$row['post_content']?></textarea></td>
			</tr>
		<?php }?>
		</table>
		<?php
	}
}

?>