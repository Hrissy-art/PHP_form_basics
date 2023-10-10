<?php
require_once 'layout/header.php';
require_once 'data/members.php';
?>

<main class="prose mx-auto">
  <h1>Bienvenue chez MyCorp</h1>

  <h2>Nos membres</h2>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <?php foreach ($members as $member) {
        require 'templates/product-item-card.php';
    } ?>
  </div>

  

    <h1>Search by name</h1>
    <form action="search.php" method="GET">
        <label for="name">Name :</label>
        <input type="text" id="name" name="name" placeholder="search for a name">
        <input type="submit" value="Serach">
    </form>


    <?php 

  if(isset($_POST['submit'])){
      $login = $_POST['login'];
      
      if(!empty($login)){
          $data = "Email:" . $login . "\n";
          $file = fopen("data.txt", "a+");
          fwrite($file, $data);
          fclose($file);
      }
  }

?>
 
</main>

<?php 


require_once 'layout/footer.php'; ?>