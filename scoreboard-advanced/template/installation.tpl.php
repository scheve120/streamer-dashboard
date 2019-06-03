<!-- html5 Login abd and regitration form. -->
<link rel="stylesheet" href="template/style.css" type="text/css">
<div class="isntallation-body">
  <div class="install-header" id="installation-header">
    <div class="navigation">
      <nav class="installation-navigation">
      <?php if (isset($_GET['create_board'])) :?>
        <a href="?&create?=create-newtable">create board </a>
      <?php else : ?>
        <a href="?&create?=tables">Check tables </a>
      <?php endif; ?>
      </nav>
    </div>
  </div>
  <div class="content-body">
    <div class="test-database">
      <form action="" method="post" name="test-database">
        <input type="text" name="board-name" placeholder="Name for the board">
        <input type="submit" name="test-db" value="test-database">
      </form>
      <br/>
      <form action="" method="post" name="test-database">
        <input type="submit" name="test-create" value="test-database">
      </form>
    </div>
    <div class="control-panel">
      <form action="" method="post" name="create-board">
        <input type="text" name="board-name" placeholder="Name for the board">
        <input type="text" name="row-numbers" placeholder="Fill in houw many rows">
      </form>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac ornare est, at accumsan sem. Donec in ultricies orci, a finibus diam. Morbi elementum bibendum vehicula.
      Maecenas ultricies turpis ligula, non hendrerit ipsum fermentum a. Donec quis lorem diam. Donec aliquam gravida diam a cursus. Vestibulum laoreet neque nisl, et aliquam orci scelerisque quis.
      Nulla ultrices pretium consequat. Aliquam eget lorem id diam egestas aliquet nec ut diam. Duis venenatis, magna vitae convallis faucibus, sem tellus pharetra enim, pharetra accumsan tortor leo vel nisi.
      Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque sed ex quam. Praesent mattis et dui vel aliquam. Morbi id sem lectus. In eget nibh erat.
    </div>
  </div>
</div>
