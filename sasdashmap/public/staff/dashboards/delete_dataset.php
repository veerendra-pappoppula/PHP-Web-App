<?php

require_once('../../../private/initialize.php');

require_login();


$report_id = $_GET['report_id'];

if(!isset($_GET['dataset_id'])) {
  redirect_to(url_for('/staff/dashboards/show.php?report_id='.$report_id));
}

$dataset_id= $_GET['dataset_id'];


if(is_post_request()) {

  delete_dataset($dataset_id);

  $_SESSION['message']= 'The dataset was deleted successfully';

  redirect_to(url_for('/staff/dashboards/show.php?report_id='.$report_id));

  

} else {

  $subject = fetch_datasets_dataset_id($dataset_id);
}

?>

<?php $page_title = 'Delete Dataset'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/dashboards/show.php?report_id='.$report_id); ?>">&laquo; Back to List</a>

  <div class="dataset delete">
    <h1>Delete Dataset</h1>
    <p>Are you sure you want to delete this dataset?</p>
    <p class="item"><?php echo h($subject['dataset_name']); ?></p>

    <form action="<?php echo url_for('/staff/dashboards/delete_dataset.php?report_id=' . h(u($subject['report_id'])).'&dataset_id='.h(u($dataset_id)) ); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Dataset" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
