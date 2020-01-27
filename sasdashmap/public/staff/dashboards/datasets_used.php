<?php

require_once('../../../private/initialize.php') ;

require_login();

$page_title='Datasets Used';

if (!isset($_GET['report_id'])){
  redirect_to(url_for('/staff/dashboards/index.php'));
}

$id= $_GET['report_id'];

$dashboard_set= fetch_dashboard();

$sql="select * from datasets_used where report_id='".$id."'";

$result= mysqli_query($db,$sql);

?>

<?php

include(SHARED_PATH.'/staff_header.php');

?>	

<div id="content">
  <div class="dataset list">
    <h1>Datasets Used</h1>
    <a class="back-link" href="<?php echo url_for('/staff/dashboards/index.php'); ?>">&laquo; Back to List</a>
  	<table class="list">
  	  <tr>
        <th>Dashboard Name</th>
        <th>Dataset Name</th>
        <th>Source SAS Library</th>
        <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($subject =mysqli_fetch_assoc($dashboard_set) ) { ?>
        <tr>
          <td><?php echo h($subject['category']) ; ?></td>
          <td><?php echo h($subject['name']) ; ?></td>
          <td><?php echo h($subject['refresh_type']) ; ?></td>
          <td><a class="action" href="<?php echo $subject['URL'] ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/dashboards/edit.php?report_id='.h(u($subject['report_id'])))?>">Edit</a></td>
          <td><a class="action" href="">Delete</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/dashboards/edit.php?report_id='.h(u($subject['report_id'])))?>">Datasets Used</a></td>
    	  </tr>
      <?php } ?>
  	</table>

  	<?php 
  		mysqli_free_result($dashboard_set);
  	?>

  </div>

</div>

<?php

include(SHARED_PATH.'/staff_footer.php');

?>	