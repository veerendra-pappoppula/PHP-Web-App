<?php

require_once('../../../private/initialize.php');

require_login();

if (!isset($_GET['report_id'])){
  redirect_to(url_for('/staff/dashboards/index.php'));
}

$report_id= $_GET['report_id'];




if (is_post_request()){


  
  $subject=[];
  $subject['category']= $_POST['category'] ?? '';
  $subject['dashboard_name']= $_POST['dashboard_name'] ?? '';
  $subject['refresh_type']= $_POST['refresh_type'] ?? '';
  $subject['url']= $_POST['url'] ?? '';
  // $subject['sas_libname']= $_POST['sas_libname'] ?? '';
  $subject['create_dt']= $_POST['create_dt'] ?? '';
  $subject['modified_dt']= $_POST['modified_dt'] ?? '';
  $subject['project_type']= $_POST['project_type'] ?? '';
  $subject['project_name']= $_POST['project_name'] ?? '';
  $subject['project_location']= str_replace("\\", "\\\\",$_POST['project_location'] ?? '');
  $subject['report_id']=$report_id;
  
  $result= update_dashboard($subject);

  $_SESSION['message']= 'The dashboard was updated successfully';

  redirect_to(url_for('/staff/dashboards/index.php'));

} else {

  $subject=fetch_dashboard_report_id($report_id);
}

?>


<?php $page_title = 'Edit Dashboard'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/dashboards/index.php'); ?>">&laquo; Back to List</a>

  <div class="dashboard edit">
    <h1>Edit Dashboard</h1>

    <form action="<?php echo url_for('/staff/dashboards/edit.php?report_id='.h(u($report_id))); ?>" method="post">
      <dl>
        <dt>Category</dt>
        <dd><input type="text" name="category" value="<?php echo h($subject['category']) ?>" required /></dd>
      </dl>
      <dl>
        <dt>Dashboard Name</dt>
        <dd><input type="text" name="dashboard_name" value="<?php echo h($subject['name']) ?>" required /></dd>
      </dl>
      <dl>
        <dt>Refresh Type</dt>
        <dd>
          <select name="refresh_type" required>
            <option value="Live"<?php if ($subject['refresh_type']=='Live') {echo " selected" ; } ?> >Live</option>
            <option value="20 min"<?php if ($subject['refresh_type']=='20 min') {echo " selected" ; } ?> >20 min</option>
            <option value="Hourly"<?php if ($subject['refresh_type']=='Hourly') {echo " selected" ; } ?> >Hourly</option>
            <option value="Daily"<?php if ($subject['refresh_type']=='Daily') {echo " selected" ; } ?> >Daily</option>
            <option value="Freeze Date"<?php if ($subject['refresh_type']=='Freeze Date') {echo " selected" ; } ?> >Freeze Date</option>
            <option value="On Request"<?php if ($subject['refresh_type']=='On Request') {echo " selected" ; } ?> >On Request</option>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>URL</dt>
        <dd><input type="text" name="url" value="<?php echo h($subject['URL']) ?>" required/></dd>
      </dl>
      <!-- <dl> added to edit datasets php file
        <dt>SAS Libname</dt>
        <dd>
          <select name="sas_libname" required>
            <option value="WCUDW"<?php if ($subject['sas_libname']=='Data Warehouse') {echo " selected" ; } ?> >Data Warehouse</option>
            <option value="WCUDATA"<?php if ($subject['sas_libname']=='Shared Folder') {echo " selected" ; } ?> >Shared Folder</option>
            <option value="WCUSREP"<?php if ($subject['sas_libname']=='SREP') {echo " selected" ; } ?> >SREP</option>
            <option value="WCUSLIVE"<?php if ($subject['sas_libname']=='SLIVE') {echo " selected" ; } ?> >SLIVE</option>
          </select>
        </dd>
      </dl> -->
      <dl>
        <dt>Date Created</dt>
        <dd><input type="date" name="create_dt" value="<?php echo h($subject['create_dt']) ?>" required /></dd>
      </dl>
      <dl>
        <dt>Date Modified</dt>
        <dd><input type="date" name="modified_dt" value="<?php echo h($subject['modified_dt']) ?>" required /></dd>
      </dl>
      <dl>
        <dt>Project Type</dt>
        <dd>
          <select name="project_type" required>
            <option value="">Please Select</option>
            <option value="SAS Project"<?php if ($subject['project_type']=='SAS Project') {echo " selected" ; } ?> >SAS Project</option>
            <option value="DW Table or View"<?php if ($subject['project_type']=='DW Table or View') {echo " selected" ; } ?> >DW Table or View</option>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Project Name</dt>
        <dd><input type="text" name="project_name" value="<?php echo h($subject['project_name']) ?>" required/></dd>
      </dl>
      <dl>
        <dt>Project Location</dt>
        <dd><input type="text" name="project_location" value="<?php echo h($subject['project_location']) ?> " /></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Save Dashboard" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
