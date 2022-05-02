<div class="users form">
	<?php echo $this->Form->create('Book', array('type' => 'file')); ?>

	<fieldset>
		<legend> <?php echo __('Issue Book'); ?> </legend>
	
	<?php
		echo $this->Form->input(
						'User.id',
						array(
							'options'=>$users,
							'empty'=>'Select Option',
							'label'=>'User ID'
							// 'type'=>'text',
							// 'label'=>'User ID',
							// 'default'=>''
							)
						);
		echo $this->Form->input(
							'Book.id',
							array(
								'options'=>$booksAvailable,
								'empty'=>'Select Option',
								'label'=>'Book ID'
							)
						);
	?>
	</fieldset>
	<?php echo $this->Form->end(__('Issue Book')); ?>
</div>