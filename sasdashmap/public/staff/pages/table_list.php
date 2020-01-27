<?php

require_once('../../../private/initialize.php') ;

require_login();

if (isset($_GET['libname'])){
  $libname=$_GET['libname'];
  $tables=fetch_table_libname($libname);
  if (!$tables) {
    redirect_to(url_for('/public/staff/pages/index.php'));
  }
} else {
  //nothing. show the home page

}

?>

<?php

include(SHARED_PATH.'/staff_header.php');

?>

<div id="content">
  <div class="table list">
    <h1>Tables</h1>
  	<table class="list">
  	  <tr>
        <th>Table Name</th>
        <th>&nbsp;</th>


  	  </tr>

      <?php while($subject =mysqli_fetch_assoc($tables) ) { ?>
        <tr>
          <td><a href="<?php echo $subject['dataset_name'] ?>" target="_blank"> <?php echo h($subject['dataset_name']) ; ?> </a></td>
        </tr>
      <?php } ?>
  	</table>

  	<?php 
  		mysqli_free_result($tables);
  	?>

  </div>

</div>

<?php

include(SHARED_PATH.'/staff_footer.php');

?>