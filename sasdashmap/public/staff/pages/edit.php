<?php

require_once('../../../private/initialize.php');




if (is_post_request()){

  $menu_name= $_POST['menu_name'] ?? '';
  $position= $_POST['position'] ?? '';
  $visible= $_POST['visible'] ?? '';

  echo "Form Parameters <br />";

  echo "Menu Name: ". $menu_name. "<br />";
  echo "Position: ". $position. "<br />";
  echo "Visible: ". $visible. "<br />";

} 

?>

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="page edit">
    <h1>Edit Page</h1>

    <form action="<?php echo url_for('/staff/subjects/edit.php?id='.h(u($id))); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($menu_name) ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <option value="1"<?php if ($position=='1') {echo " selected" ; } ?> >1</option>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" <?php if ($visible=='1') {echo " checked" ; } ?> />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Page" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
