<?php

require_once('../../../private/initialize.php');

require_login();

if (!isset($_GET['report_id'])){
  redirect_to(url_for('/staff/dashboards/index.php'));
}

$report_id= $_GET['report_id'];

if (!isset($_GET['dataset_id'])){
  redirect_to(url_for('/staff/dashboards/index.php'));
}

$dataset_id= $_GET['dataset_id'];




if (is_post_request()){


  
  $subject=[];
  $subject['sas_libname']= $_POST['sas_libname'] ?? '';
  $subject['dataset_name']= $_POST['dataset_name'] ?? '';
  $subject['report_id']=$report_id;
  $subject['dataset_id']=$dataset_id;
  
  $result= update_datasets($subject);

  $_SESSION['message']= 'The datasets were updated successfully';

  redirect_to(url_for('/staff/dashboards/show.php?report_id='.$report_id));

} else {

  $subject=fetch_datasets_report_id($report_id);
}

?>


<?php $page_title = 'Edit Datasets'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/dashboards/index.php'); ?>">&laquo; Back to List</a>

  <div class="dataset edit">
    <h1>Edit Datasets</h1>

    <form action="<?php echo url_for('/staff/dashboards/edit_datasets.php?report_id='.h(u($report_id)).'&dataset_id='.h(u($dataset_id))); ?>" method="post">
       <dt>SAS Libname</dt>
        <dd>
          <select name="sas_libname" required>
            <option value="WCUDW"<?php if ($subject['sas_libname']=='Data Warehouse') {echo " selected" ; } ?> >Data Warehouse-WCUDW</option>
            <option value="WCUDATA"<?php if ($subject['sas_libname']=='Shared Folder') {echo " selected" ; } ?> >Shared Folder-WCUDATA</option>
            <option value="WCUSREP"<?php if ($subject['sas_libname']=='SREP') {echo " selected" ; } ?> >SREP</option>
            <option value="WCUSLIVE"<?php if ($subject['sas_libname']=='SLIVE') {echo " selected" ; } ?> >SLIVE</option>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Dataset Name</dt>
        <dd><input type="text" name="dataset_name" value="<?php echo h($subject['dataset_name']) ?>" required /></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Dataset" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
