<?php

require_once('../../../Private/initialize.php') ;

require_login();

$page_title='Dashboards';

$dashboard_set= fetch_dashboard();

$category_set=fetch_distinct_category();

?>

<?php

include(SHARED_PATH.'/staff_header.php');

?>	

<div id="content">
  <div class="dashboard list">
    <h1>Dashboards</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/dashboards/new.php')?>">Create New Dashboard Link</a>
    </div>

    <br >
    <br >

    <div class="optionsDiv">
        Filter By Category: 
        <select id="selectField">
            <option value="All" selected>All</option>
            <?php while($cat =mysqli_fetch_assoc($category_set) ) { ?>
              <option value="<?php echo h($cat['category']) ; ?>" ><?php echo h($cat['category']) ; ?></option>
            <?php } ?>

        </select>
   
    </div>

    <br >
    <br >

  	<table class="list" id="dash">
  	  <tr>
        <th>Category</th>
        <th>Dashboard ID</th>
        <th>Dashboard Name</th>
        <th>Refresh Type</th>
        <th>Date Created</th>
        <th>Date Modified</th>
        <th>Project Type</th>
        <th>Project Name</th>
        <th>Project Location</th>
        <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($subject =mysqli_fetch_assoc($dashboard_set) ) { ?>
        <tr category="<?php echo h($subject['category']) ; ?>">
          <td><?php echo h($subject['category']) ; ?></td>
          <td><?php echo h($subject['report_id']) ; ?></td>
          <td><?php echo h($subject['name']) ; ?></td>
          <td><?php echo h($subject['refresh_type']) ; ?></td>
          <td><?php echo h($subject['create_dt']) ; ?></td>
          <td><?php echo h($subject['modified_dt']) ; ?></td>
          <td><?php echo h($subject['project_type']) ; ?></td>
          <td><?php echo h($subject['project_name']) ; ?></td>
          <td> <?php echo h($subject['project_location']) ; ?> </a></td>
          <td><a class="action" href="<?php echo $subject['URL'] ?>" target="_blank">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/dashboards/edit.php?report_id='.h(u($subject['report_id'])))?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/dashboards/delete.php?report_id='.h(u($subject['report_id'])))?>">Delete</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/dashboards/show.php?report_id='.h(u($subject['report_id'])).'&name='.h(u($subject['name'])) )?>">Datasets Used</a></td>
    	  </tr>
      <?php } ?>
  	</table>

  	<?php 
  		mysqli_free_result($dashboard_set);
  	?>

  </div>

</div>

<script type="text/javascript" stylesheet="../stylesheets/staff.css">
$(document).ready(function() {

    function addRemoveClass(theRows) {

        theRows.removeClass("odd even");
        theRows.filter(":odd").addClass("odd");
        theRows.filter(":even").addClass("even");
    }

    var rows = $("table#dash tr:not(:first-child)");

    addRemoveClass(rows);


    $("#selectField").on("change", function() {

        var selected = this.value;

        if (selected != "All") {

            rows.filter("[category=" + '"'+selected + '"'+ "]").show();
            rows.not("[category=" + '"'+selected + '"'+ "]").hide();
            var visibleRows = rows.filter("[category=" + '"'+selected + '"'+ "]");
            addRemoveClass(visibleRows);
        } else {

            rows.show();
            addRemoveClass(rows);

        }

    });
});
</script>

<?php

include(SHARED_PATH.'/staff_footer.php');

?>	