
<?php if (count($errors) > 0) : ?>

  <div class="error">
  	<?php foreach ($errors as $error) : ?>

  	  <p><b><?php echo $error ?></b></p>
      
  	<?php endforeach ?>
  </div>
<?php  endif ?>



<?php if (count($sucesss) > 0) : ?>
  <div class="sucesss">
  	<?php foreach ($sucesss as $sucesss) : ?>
  	  <p><b><?php echo $sucesss ?></b></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>