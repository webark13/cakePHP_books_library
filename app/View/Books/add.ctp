<h2><?php echo __('Add Book'); ?></h2>
<?php
  echo $this->Form->create('Book', array('type' => 'file'));
  echo $this->Form->input('title');
  echo $this->Form->input('author');
  echo $this->Form->input('units');
  echo $this->Form->file('file', array('type' => 'file'));
?>
<div class="required">
	<small>Only pdf file type is allowed</small>	
</div>
<?php
  echo $this->Form->end('Add Book');
?>