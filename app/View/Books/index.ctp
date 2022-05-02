

<h2><?php echo __('Books'); ?></h2>


 <table class="table table-striped table-hover table-bordered">
  
    <tr class="thead-dark">
      <th>Book ID</th>
      <th>Title</th>
      <th>Author</th>
      <th>Published</th>
      <th>Available</th>
    </tr>
   
   <tbody>
   	
   
	<?php foreach($books as $book):  ?>
	  <tr>
	  	<td><?php echo $book['Book']['id']; ?></td>
		<td>
			<?php echo $book['Book']['title']; 
			?>
		</td>
		<td><?php echo $book['Book']['author']; ?></td>
		<td> <?Php echo $this->Time->nice($book['Book']['created']); ?></td>
		<td><?php echo $book['Book']['units']; ?>
				 	
		</td>
	  </tr>
	  <?php  endforeach; ?>
	 </tbody>
  </table>

