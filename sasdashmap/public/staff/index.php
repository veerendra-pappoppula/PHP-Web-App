<?php

require_once('../../private/initialize.php') ;

require_login();

$page_title='Staff Menu';

?>

<?php

include(SHARED_PATH.'/staff_header.php');

?>	

<div id="content">
	<div id="main-menu">
  		<h2>Main Menu</h2>
  		<ul>
   			<li><a href="<?php echo url_for('/staff/dashboards/index.php') ?>">Dashboards</a>
			</li>
			<li><a href="<?php echo url_for('/staff/pages/index.php') ?>">Tables by Database</a>
			</li>
			<li><a href="<?php echo url_for('/staff/pages/new.php') ?>">Find Dashboards related to a column</a>
			</li>
  		</ul>
	</div>
</div>

<?php

include(SHARED_PATH.'/staff_footer.php');

?>	