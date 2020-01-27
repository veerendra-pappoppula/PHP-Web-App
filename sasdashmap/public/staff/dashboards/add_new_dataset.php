<?php

require_once('../../../private/initialize.php');

require_login();

if (!isset($_GET['report_id'])){
  redirect_to(url_for('/staff/dashboards/index.php'));
}

$report_id= $_GET['report_id'];

// if (!isset($_GET['dataset_id'])){
//   redirect_to(url_for('/staff/dashboards/index.php'));
// }

// $dataset_id= $_GET['dataset_id'];




if (is_post_request()){


  
  // $subject=[];
  // $subject['sas_libname']= $_POST['sas_libname'] ?? '';
  // $subject['dataset_name']= $_POST['dataset_name'] ?? '';
  // $subject['report_id']=$report_id;
  // $subject['dataset_id']=$dataset_id;

  $textval=$_POST['textVal'] ?? '';
  $sas_libname=$_POST['sas_libname'] ?? '';

  $it = new MultipleIterator();
  $it->attachIterator(new ArrayIterator($sas_libname));
  $it->attachIterator(new ArrayIterator($textval));
  //Add more arrays if needed 

  foreach($it as $a) {
      insert_datasets_used($report_id,$a[0],$a[1]);

      // echo $a[0] . "<br>";
      // echo $a[1] . "<br><br>";
  }
  
  $_SESSION['message']= 'The datasets were added successfully';

  redirect_to(url_for('/staff/dashboards/show.php?report_id='.$report_id));

} 

?>


<?php $page_title = 'Add Datasets'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <div class="add dataset">
    <h1>Add Datasets</h1>

    <form action="<?php echo url_for('/staff/dashboards/add_new_dataset.php?report_id='.h(u($report_id))); ?>" method="post">
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
        <input type="submit" value="Add Datasets" />
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
                $("#textboxDiv").append(' <br /> <select name="sas_libname[]" required> <option value="WCUDW">Data Warehouse</option>   <option value="WCUDATA" >Shared Folder</option>      <option value="WCUSREP" >SREP</option>     <option value="WCUSLIVE">SLIVE</option> </select>  <input type="text" name="textVal[]" value="" />  <br /> ');
            }
        }
    });
});
</script>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
