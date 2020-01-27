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

?>

<div id="content">
  <div class="dashboard list">
    <h1>Dashboards</h1>
  	<table class="list">
  	  <tr>
        <th>Dashboard Name</th>
        <th>Refresh Type</th>
        <th>&nbsp;</th>


  	  </tr>

      <?php while($subject =mysqli_fetch_assoc($dashboards) ) { ?>
        <tr>
          <td><a href="<?php echo $subject['URL'] ?>" target="_blank"> <?php echo h($subject['name']) ; ?> </a></td>
          <td><?php echo h($subject['refresh_type']) ; ?></td>
          <td><a class="action" href="<?php echo $subject['URL'] ?>" target="_blank">View</a></td>
    	  </tr>
      <?php } ?>
  	</table>

  	<?php 
  		mysqli_free_result($dashboards);
  	?>

  </div>

</div>