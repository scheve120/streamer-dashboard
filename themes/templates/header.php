
<?php if (!empty($_SESSION["user_online"])): ?>
  <div id="logout" class="tablecontent">
    <form action="" method="post" name="logout">
      <input type="submit" name="logout" value="logout">
    </form>
  </div>

<?php endif; ?>

<div style="background-color:powderblue;">
  <h1>Header location from a requirement in php.
    Also for testing some options how to build up a template function</h1>
</div>

<?php if (!empty($page_message)): ?>
  <div class="errors">
    <?php echo $page_message; ?>
  </div>
<?php endif; ?>
