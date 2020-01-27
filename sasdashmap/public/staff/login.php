<?php
require_once('../../private/initialize.php');

$errors = [];
$username = '';
$password = '';

if(is_post_request()) {

  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  if (is_blank($username)){
    $errors[] = "Username cannot be blank";

  }

  if (is_blank($password)){
    $errors[] = "Password cannot be blank";
    
  }
  
  // process the form
  if (empty($errors)) {

    $admin= find_admin($username);

    if($admin) {

      if ($password==$admin['hashed_password'])
        {
        log_in_admin($admin);

        redirect_to(url_for('/staff/index.php'));
        } else {
          $errors[]= "Log in was unsuccessful.";
        } 
    }

  } else {
    $errors[]= "Log in was unsuccessful.";
  }

  
}

?>

<?php $page_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <h1>Log in</h1>

  <?php echo display_errors($errors); ?>

  <form action="login.php" method="post">
    Username:<br />
    <input type="text" name="username" value="<?php echo h($username); ?>" /><br />
    Password:<br />
    <input type="password" name="password" value="" /><br />
    <input type="submit" name="submit" value="Submit"  />
  </form>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
