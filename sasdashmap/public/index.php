<?php

require_once('../private/initialize.php') ;

if (isset($_GET['category'])){
	$category=$_GET['category'];
	$dashboards=fetch_dashboard_category($category);
	if (!$dashboards) {
		redirect_to(url_for('index.php'));
	}
} else {
	//nothing. show the home page

}

include(SHARED_PATH.'/public_header.php');

?>	


<div id="main">
	<?php include(SHARED_PATH.'/public_navigation.php'); ?>

	<div id="page">


		<?php 
		if (isset($dashboards)){
			//show dashboards from the database

			

			include(SHARED_PATH.'/dashboard_list.php');

			

		} else {
		include(SHARED_PATH.'/static_homepage.php'); 

	    } ?>
	</div>
</div>

<?php

include(SHARED_PATH.'/public_footer.php');

?>	