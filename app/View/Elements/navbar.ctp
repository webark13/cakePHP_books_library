<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
   <?php echo $this->Html->link('Library', array(
                'controller'=>'books', 'action'=>'index'),
                array('class'=>'navbar-brand'));
    ?>
 
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
     <?php echo '<li class="nav-item">';
            echo $this->Html->link('Home', array(
                'controller'=>'books', 'action'=>'index'),
                array('class'=>'nav-link'));
            echo '</li>';
        ?>

        <!-- if user loggd in show login and profile links -->
        <?php if(AuthComponent::user()) {
            echo '<li class="nav-item">';
            echo $this->Html->link('Log out', array(
                    'controller'=>'users', 'action'=>'logout'),
                    array('class'=>'nav-link'));
            echo '</li>';
            echo '<li class="nav-item">';
            echo $this->Html->link('Profile', array(
                    'controller'=>'users', 'action'=>'profile'),
                    array('class'=>'nav-link'));
            echo '</li>';
            // if admin is logged in show him add, issue and return links
            if($this->Session->read('Auth')['User']['role'] == 'admin') {
                echo '<li class="nav-item">';
                echo $this->Html->link('Add Book', array(
                        'controller'=>'books', 'action'=>'add'),
                        array('class'=>'nav-link'));
                echo '</li>';
                echo '<li class="nav-item">';
                echo $this->Html->link('Issue Book', array(
                        'controller'=>'stocks', 'action'=>'issue'),
                        array('class'=>'nav-link'));
                echo '</li>';
                echo '<li class="nav-item">';
                echo $this->Html->link('Return Book', array(
                        'controller'=>'stocks', 'action'=>'returnBook'),
                        array('class'=>'nav-link'));
            }
        } else {
            
            echo '<li class="nav-item">';
            echo $this->Html->link('Login', array(
                    'controller'=>'users', 'action'=>'login'),
                    array('class'=>'nav-link'));
            echo '</li>';
        }
        ?>
      
      
    </ul>
  </div>
</nav>