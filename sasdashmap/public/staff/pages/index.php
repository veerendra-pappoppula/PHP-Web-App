<?php


require_once('../../../private/initialize.php') ;

require_login();

$page_title='Databases or SAS Libraries';

if (isset($_GET['libname'])){
  $libname=$_GET['libname'];
  $table_list=fetch_table_libname($libname);



  if (!$table_list) {
    redirect_to(url_for('index.php'));
  }
} 


?>

<?php

include(SHARED_PATH.'/staff_header.php');

?>	

<div id="main">

  <?php include(SHARED_PATH.'/page_navigation.php'); ?>

  <div id="page">


    <?php 
    if (isset($libname)){

      //show dashboards from the database
        // echo $libname;

     
        

        include(SHARED_PATH.'/table_list.php');
       

      

    } else {
    
      // echo 'Please select a Database name or Library Name'; 

      } ?>
  </div>
</div>


<?php

include(SHARED_PATH.'/staff_footer.php');

?>	