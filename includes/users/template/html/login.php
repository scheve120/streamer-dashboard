<!-- html5 Login abd and regitration form. -->
<link rel="stylesheet" href="./includes/users/template/css/user.css" type="text/css">
  <div class="account-forms">
<?php if (isset($_GET['account-recovery'])) : ?>
  <form action="" method="post" name="account-recover">
    <input type="hidden" name="selector" value="<?php $_GET['selector'] ?>">
    <input type="hidden" name="validator" value="<?php $_GET['validator'] ?>">
    <label><p>Password: </label><input type="password" placeholder="password" name="password1" value="<?php print htmlentities($password1); ?>"></p>
    <label><p>Confirmation password: </label><input type="password" placeholder="nogmaals password voor controle"  name="password2"></p>
    <input type="submit" name="recover-password" value="Reset password">
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
        <p><label>Username: </label><input type="text"  placeholder="User name"  name="username"></p>
        <p><label>Password: </label><input type="password" placeholder="Password" name="password"></p>
        <input type="submit" name="login-button" value="Login">
      </form>
    </section>

    <section class="register">
      <form action="" method="post"  name="registreer">
        <p><label>Username </label><input type="text"  placeholder="User name?"  name="username" value="<?php print htmlentities($username); ?>"></p>
        <p><label>Email </label><input type="email" placeholder="Email" name="email1" value="<?php print htmlentities($email1); ?>"></p>
        <p><label>Verification email </label><input type="email" placeholder="email" name="email2" value="<?php print htmlentities($email2); ?>"></p>
        <p><label>Password </label><input type="password" placeholder="password" name="password1" value="<?php print htmlentities($password1); ?>"></p>
        <p><label>Confirmation password </label><input type="password" placeholder="nogmaals password voor controle"  name="password2"></p>
        <p><input type="submit" name="register-button" value="Registrate"></p>
      </form>
    </section>

    <section class="reset">
      <form action="" method="post" name="password-reset">
        <p><label>Enter email:</label><input type="email" placeholder="Email" name="email"></p>
        <input type="submit" name="send-token" value="Recover password">
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
