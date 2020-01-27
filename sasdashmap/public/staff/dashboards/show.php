<?php require_once('../../../private/initialize.php'); 

require_login();

?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
if (!isset($_GET['report_id'])){
  redirect_to(url_for('/staff/dashboards/index.php'));
}

// if (!isset($_GET['name'])){
//   redirect_to(url_for('/staff/dashboards/index.php'));
// }


$report_id = $_GET['report_id'] ?? ''; // PHP > 7.0

$name = $_GET['name'] ?? '';

$sql="select * from datasets_used where report_id='".$report_id."'";

$result= mysqli_query($db,$sql);

?>

<?php $page_title = 'Show Datasets Used'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/dashboards/index.php'); ?>">&laquo; Back to List</a>

  <div class="dataset show">
  	<h1> Datasets used </h1> 

  	<a class="add new link" href="<?php echo url_for('/staff/dashboards/add_new_dataset.php?report_id='.h(u($report_id))); ?>"> Add New Dataset(s)</a>

    <br> 
  	</br> 
  	


    <table class="list">
  	  <tr>
        <th>Dashboard ID</th>
  	  	<th>Dataset SAS Libname</th>
        <th>Dataset Name</th>
        <th>Dataset ID</th>
        <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($subject =mysqli_fetch_assoc($result) ) { ?>



        <tr>
          <td><?php echo h($subject['report_id']) ; ?></td>
          <td><?php echo h($subject['sas_libname']) ; ?></td>
          <td><?php echo h($subject['dataset_name']) ; ?></td>
          <td><?php echo h($subject['dataset_id']) ; ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/dashboards/show_columns.php?report_id='.h(u($subject['report_id'])).'&dataset_name='.h(u($subject['dataset_name'])))?>">View Columns</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/dashboards/edit_datasets.php?report_id='.h(u($subject['report_id'])).'&dataset_id='.h(u($subject['dataset_id'])))?>">Edit Dataset Name</a></td>

          <td><a class="action" href="<?php echo url_for('/staff/dashboards/delete_dataset.php?report_id='.h(u($subject['report_id'])).'&dataset_id='.h(u($subject['dataset_id'])))?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>