<?php
require_once 'layout/header.php';
require_once 'data/members.php'; ?>
<h1>Résultat de la recherche pour</h1>
  <?php
if(isset($_GET['name'])) {
    $nameGet = $_GET['name'];


    foreach ($members as $member) {
        if (strcmp($nameGet, $member['name']) === 0) {
            echo "Name : " . ($member['name']) ;
            echo "Firstname : " . ($member['firstname']);
            echo "Birthday : " . ($member['birthDate']) ;

        }
    }
}
               ?>