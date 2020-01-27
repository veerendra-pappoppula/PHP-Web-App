<?php require_once('../../../private/initialize.php'); 

require_login();

?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
if (!isset($_GET['dataset_name'])){
  redirect_to(url_for('/staff/dashboards/index.php'));
}

if (!isset($_GET['report_id'])){
  redirect_to(url_for('/staff/dashboards/index.php'));
}

$id = $_GET['report_id'] ?? '';


$dataset_name = $_GET['dataset_name'] ?? ''; // PHP > 7.0


$sql="select * from datasets_columns where lower(dataset_name)=lower('".$dataset_name."')";

$result= mysqli_query($db,$sql);

?>

<?php $page_title = 'Columns'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/dashboards/show.php?report_id='.h(u($id))); ?>">&laquo; Back to Datasets List</a>

  <div class="column show">
  	<h3> Columns in <?php echo h($dataset_name) ; ?> </h3> 
    <table class="list">
  	  <tr>
        <th>Dataset ID</th>
        <th>SAS Library</th>
        <th>Dataset Name</th>
        <th>Columns</th>

  	  </tr>

      <?php while($subject =mysqli_fetch_assoc($result) ) { ?>
        <tr>
          <td><?php echo h($subject['dataset_id']) ; ?></td>
          <td><?php echo h($subject['libname']) ; ?></td>
          <td><?php echo h($subject['dataset_name']) ; ?></td>
          <td><?php echo h($subject['column_name']) ; ?></td>
          
    	  </tr>
      <?php } ?>
  	</table>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>