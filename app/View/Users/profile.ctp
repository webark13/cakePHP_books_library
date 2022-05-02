<?php

// pr($userDetails);

// exit();

?>
<h2><?php echo __('Your Books')?></h2>
<table class="table table-striped table-hover table-bordered">
	<tr class="thead-dark">
		<th>Book ID</th>
		<th>Book Title</th>
		<th>Book Author</th>
		<th>Book Issue</th>
		<th>Book Returned</th>
	</tr>
	<?php foreach($userDetails as $detail): ?>
	<tr>
		<td><?php echo $detail['Book']['id'];  ?></td>
		<td><?php echo $detail['Book']['title']; ?></td>
		<td><?php echo $detail['Book']['author']; ?></td>
		<td><?php echo $this->Time->nice($detail['Stock']['created']); ?></td>
		<td><?php
				if($detail['Stock']['return'] == true) {
					echo $this->Time->nice($detail['Stock']['modified']);
				}
			?>
				 	
		</td>
	</tr>

<?php endforeach; ?>
</table>