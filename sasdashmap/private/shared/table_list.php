<?php



// require_once('../private/initialize.php') ;

// require_login();

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



    <h1>Tables</h1>

    <!-- <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a> -->


    <table class="list">
  	  <tr>
        <th>Table Name</th>
        


  	  </tr>

      <?php while($subject =mysqli_fetch_assoc($tables) ) { ?>
        <tr>
          <td><a href="<?php echo url_for('/staff/pages/column_list.php?libname='.h(u($libname))).'&dataset_name='.$subject['dataset_name'] ?>" > <?php echo h($subject['dataset_name']) ; ?> </a></td>
        </tr>
      <?php } ?>
  	</table>

  	<?php 
  		mysqli_free_result($tables);
  	?>





