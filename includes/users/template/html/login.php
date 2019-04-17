<!-- html5 Login abd and regitration form. -->
<link rel="stylesheet" href="./includes/users/template/css/user.css" type="text/css">
  <div class="account-forms">
<?php if (isset($_GET['password-reset'])) : ?>

  <form action="index.php" method="get" name="account-recover">
    <p>Password: <input type="password" placeholder="password" name="password1" value="<?php print htmlentities($password1); ?>"></p>
    <p>Confirmation password: <input type="password" placeholder="nogmaals password voor controle"  name="password2"></p>
    <input type="submit" name="account-recover" value="Reset password">
  </form>

<?php else : ?>

<?php if (empty($_SESSION["user_online"])) : ?>


    <nav>
      <button class="login">Login</button>
      <button class="register">Register</button>
      <button class="reset">Password recover</button>
    </nav>

    <section class="login">
      <form action="" method="post"  name="Login">
        <p>Username: <input type="text"  placeholder="User name"  name="user_name"></p>
        <p>Password: <input type="password" placeholder="Password" name="password"></p>
        <input type="submit" name="login-button" value="Login">
      </form>
    </section>

    <section class="register">
      <form action="" method="post"  name="registreer">
        <p>Username: <input type="text"  placeholder="User name?"  name="user_name" value="<?php print htmlentities($name); ?>"></p>
        <p>Email: <input type="email" placeholder="Email" name="email1" value="<?php print htmlentities($email1); ?>"></p>
        <p>Verification email: <input type="email" placeholder="email" name="email2" value="<?php print htmlentities($email2); ?>"></p>
        <p>Password: <input type="password" placeholder="password" name="password1" value="<?php print htmlentities($password1); ?>"></p>
        <p>Confirmation password: <input type="password" placeholder="nogmaals password voor controle"  name="password2"></p>
        <input type="submit" name="register-button" value="Registrate">
      </form>
    </section>

    <section class="reset">
      <form action="" method="post" name="password-reset">
        <p>Enter email:</p>
        <input type="email" placeholder="Email" name="email">
        <input type="submit" name="reset-password" value="Recover password">
      </form>
    </section>
  </div>
<?php else : ?>

<?php endif; ?>

<script type="text/javascript">
  var form_key = '<?php echo $form_key; ?>';
</script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="./includes/users/template/js/user.js"></script>
<?php endif; ?>
