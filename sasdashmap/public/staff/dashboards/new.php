
<?php

require_once('../../../private/initialize.php');

require_login();

$category='';
$dashboard_name='';
$refresh_type='';
$url='';
$sas_libname=[];
$report_id='';
$create_dt='';
$modified_dt='';
$project_type='';
$project_name='';
$project_location='';
$textval=[];
$i=0;


if (is_post_request()){
  $i=0;
  
  $subject=[];
  $subject['category']= $_POST['category'] ?? '';
  $subject['dashboard_name']= $_POST['dashboard_name'] ?? '';
  $subject['refresh_type']= $_POST['refresh_type'] ?? '';
  $subject['url']= $_POST['url'] ?? '';
  $subject['create_dt']= $_POST['create_dt'] ?? '';
  $subject['modified_dt']= $_POST['modified_dt'] ?? '';
  // $dataset_name= $_POST['dataset_name'] ?? '';
  $subject['project_type']= $_POST['project_type'] ?? '';
  $subject['project_name']= $_POST['project_name'] ?? '';
  $subject['project_location']= str_replace("\\", "\\\\",$_POST['project_location'] ?? '');
  $textval=$_POST['textVal'] ?? '';
  $sas_libname=$_POST['sas_libname'] ?? '';

  // print_r($_POST['sas_libname']);

  // print_r($_POST['textVal']);

  // echo '<br />';

  // print_r($_POST['lname']);

  $dashboard_set= fetch_dashboard();

  while($dashboard =mysqli_fetch_assoc($dashboard_set) )
  {
    if (strtolower($dashboard['name'])== strtolower($subject['dashboard_name'])) {
      $i=$i+1;
    }
  }

  if ($i==0) {
  
  $result= insert_dashboard($subject);
  $new_report_id= mysqli_insert_id($db);



  $it = new MultipleIterator();
  $it->attachIterator(new ArrayIterator($sas_libname));
  $it->attachIterator(new ArrayIterator($textval));
  //Add more arrays if needed 

  foreach($it as $a) {
      insert_datasets_used($new_report_id,$a[0],$a[1]);

      // echo $a[0] . "<br>";
      // echo $a[1] . "<br><br>";
  }
  
  $_SESSION['message']= 'The dashboard was created successfully';
  redirect_to(url_for('/staff/dashboards/show.php?report_id='.$new_report_id));

  // echo $new_report_id;
  // echo "Category: ". $category. ""; to view the form information after hitting submit
  // echo "Dashboard Name: ". $dashboard_name. "";
  // echo "Refresh Type: ". $refresh_type. "";
} else {
  $_SESSION['message']= 'The dashboard already exists';
  redirect_to(url_for('/staff/dashboards/index.php'));
}


//   } else {

//   redirect_to(url_for('/staff/dashboards/new.php'));
// }
}


?>

<?php $page_title = 'Create Dashboard'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/dashboards/index.php'); ?>">&laquo; Back to List</a>

  <div class="dashboard new">
    <h1>Create Dashboard</h1>

    <form action="<?php echo url_for('/staff/dashboards/new.php'); ?>" method="post">
      <dl>
        <dt>Category</dt>
        <dd><input type="text" name="category" value="<?php echo h($category) ?>" required /></dd>
      </dl>
      <dl>
        <dt>Dashboard Name</dt>
        <dd><input type="text" name="dashboard_name" value="<?php echo h($dashboard_name) ?>" required /></dd>
      </dl>
      <dl>
        <dt>Refresh Type</dt>
        <dd>
          <select name="refresh_type" required>
            <option value="">Please Select</option>
            <option value="Live"<?php if ($refresh_type=='Live') {echo " selected" ; } ?> >Live</option>
            <option value="20 min"<?php if ($refresh_type=='20 min') {echo " selected" ; } ?> >20 min</option>
            <option value="Hourly"<?php if ($refresh_type=='Hourly') {echo " selected" ; } ?> >Hourly</option>
            <option value="Daily"<?php if ($refresh_type=='Daily') {echo " selected" ; } ?> >Daily</option>
            <option value="Freeze Date"<?php if ($refresh_type=='Freeze Date') {echo " selected" ; } ?> >Freeze Date</option>
            <option value="On Request"<?php if ($refresh_type=='On Request') {echo " selected" ; } ?> >On Request</option>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>URL</dt>
        <dd><input type="text" name="url" value="<?php echo h($url) ?>" required/></dd>
      </dl>
      
      <dl>
        <dt>Date Created</dt>
        <dd><input type="date" name="create_dt" value="<?php echo h($create_dt) ?>" required /></dd>
      </dl>
      <dl>
        <dt>Date Modified</dt>
        <dd><input type="date" name="modified_dt" value="<?php echo h($modified_dt) ?>" required /></dd>
      </dl>
      <dl>
        <dt>Project Type</dt>
        <dd>
          <select name="project_type" required>
            <option value="">Please Select</option>
            <option value="SAS Project"<?php if ($project_type=='SAS Project') {echo " selected" ; } ?> >SAS Project</option>
            <option value="DW Table or View"<?php if ($project_type=='DW Table or View') {echo " selected" ; } ?> >DW Table or View</option>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Project Name</dt>
        <dd><input type="text" name="project_name" value="<?php echo h($project_name) ?>" required/></dd>
      </dl>
      <dl>
        <dt>Project Location</dt>
        <dd><input type="text" name="project_location" value="<?php echo h($project_location) ?> " /></dd>
      </dl>
      <!-- <dl> //sas_libname should repeat for each dataset.
        <dt>SAS Libname</dt>
        <dd>
          <select name="sas_libname" required>
            <option value="WCUDW"<?php if ($sas_libname=='Data Warehouse') {echo " selected" ; } ?> >Data Warehouse</option>
            <option value="WCUDATA"<?php if ($sas_libname=='Shared Folder') {echo " selected" ; } ?> >Shared Folder</option>
            <option value="WCUSREP"<?php if ($sas_libname=='SREP') {echo " selected" ; } ?> >SREP</option>
            <option value="WCUSLIVE"<?php if ($sas_libname=='SLIVE') {echo " selected" ; } ?> >SLIVE</option>
          </select>
        </dd>
      </dl> -->
      <!-- <dl>
        <dt>Dataset Name</dt>
        <dd><input type="text" name="dataset_name" value="<?php echo h($dataset_name) ?>" required /></dd>
      </dl> -->
      <dl>  
        <dt>No of Datasets</dt>
        <dd><select name="numDash" id="dropdown">
              <option value="">Please Select</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
        </select></dd>
      </dl>

      <div id="textboxDiv">
        </div>
      <div id="operations">
        <input type="submit" value="Create Dashboard" />
      </div>
    </form>

  </div>

</div>

<script type="text/javascript" stylesheet="../stylesheets/staff.css">
$(document).ready(function() {
    $("#dropdown").change(function() {
        var selVal = $(this).val();
        $("#textboxDiv").html('');
        if(selVal > 0) {
            for(var i = 1; i<= selVal; i++) {
                $("#textboxDiv").append(' <br /> <select name="sas_libname[]" required> <option value="WCUDW">Data Warehouse-WCUDW</option>   <option value="WCUDATA" >Shared Folder-WCUDATA</option>      <option value="WCUSREP" >SREP</option>     <option value="WCUSLIVE">SLIVE</option> </select>  <input type="text" name="textVal[]" value="" />  <br /> ');
            }
        }
    });

    function addRemoveClass(theRows) {

        theRows.removeClass("odd even");
        theRows.filter(":odd").addClass("odd");
        theRows.filter(":even").addClass("even");
    }

    var rows = $("table#myTable tr:not(:first-child)");

    addRemoveClass(rows);


    $("#selectField").on("change", function() {

        var selected = this.value;

        if (selected != "All") {

            rows.filter("[category=" + selected + "]").show();
            rows.not("[category=" + selected + "]").hide();
            var visibleRows = rows.filter("[category=" + selected + "]");
            addRemoveClass(visibleRows);
        } else {

            rows.show();
            addRemoveClass(rows);

        }

    });
});
</script>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
