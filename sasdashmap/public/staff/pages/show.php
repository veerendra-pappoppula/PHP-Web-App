<?php require_once('../../../private/initialize.php'); 

require_login();
?>


<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
// $id = $_GET['id'] ?? '1'; // PHP > 7.0

if (!isset($_POST['column_name'])){
  redirect_to(url_for('/staff/pages/new.php'));
}

  $column_name= $_POST['column_name'] ?? '';

  $sas_libname= $_POST['sas_libname'] ?? '';

  $sql="select column_name, a.dataset_name, libname,name from datasets_columns a left join datasets_used b on lower(a.dataset_name)=lower(b.dataset_name) left join dashboards c on b.report_id= c.report_id where ";
  $sql .= "column_name like ('%".$column_name."%') ";

  if ($sas_libname) {

  $sql .= "and libname like ('%".$sas_libname."%') ";

  }

  $result= mysqli_query($db,$sql);
  // while($subject =mysqli_fetch_assoc($result) ){
  // 	echo h($subject['dataset_name']);

  // }
  // if ($result) {
		// 	return true;
		// } else {

		// 	echo mysqli_error($db);
		// 	db_disconnect($db);
		// 	exit;
		// }

?>

<?php $page_title = 'Show Column Info'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/pages/new.php'); ?>">&laquo; Find a new column</a>


  <div class="dataset show">
  	<h1> Dashboards using <?php echo h($column_name) ; ?> </h1>
    <table class="list">
      <tr>
        <th>Column Name</th>
        <th>Dataset Name</th>
        <th>SAS Libname</th>
        <th>Report Name</th>

      </tr>

      <?php while($subject =mysqli_fetch_assoc($result) ) { ?>
        <tr>
          <td><?php echo h($subject['column_name']) ; ?></td>
          <td><?php echo h($subject['dataset_name']) ; ?></td>
          <td><?php echo h($subject['libname']) ; ?></td>
          <td><?php echo h($subject['name']) ; ?></td>
          
        </tr>
      <?php } ?>
    </table>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
