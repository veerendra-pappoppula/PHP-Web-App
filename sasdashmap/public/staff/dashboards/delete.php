<?php

require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['report_id'])) {
  redirect_to(url_for('/staff/dashboards/index.php'));
}
$report_id = $_GET['report_id'];




if(is_post_request()) {

  delete_dashboard($report_id);

  $_SESSION['message']= 'The dashboard was deleted successfully';

  redirect_to(url_for('/staff/dashboards/index.php'));

} else {

  $subject = fetch_dashboard_report_id($report_id);
}

?>

<?php $page_title = 'Delete Dashboard'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/dashboards/index.php'); ?>">&laquo; Back to List</a>

  <div class="dashboard delete">
    <h1>Delete Dashboard</h1>
    <p>Are you sure you want to delete this dashboard?</p>
    <p class="item"><?php echo h($subject['name']); ?></p>

    <form action="<?php echo url_for('/staff/dashboards/delete.php?report_id=' . h(u($subject['report_id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Dashboard" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
