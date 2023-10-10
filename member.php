<?php
require_once 'layout/header.php';
require_once 'data/members.php';
require_once 'functions.php';

if (!isset($_GET['id'])) {
    http_response_code(404);
    echo "Membre non trouvé";
    exit;
}

// Si je suis à ce niveau du code, cela signifie que
// l'ID existe bien en tant que paramètre GET
// $id = intval($_GET['id']);
['id' => $id] = $_GET;

if (!is_numeric($id)) {
    http_response_code(404);
    echo "Membre non trouvé";
    exit;
}

// Si j'arrive à ce niveau du code, cela signifie que
// l'ID existe et a bien une valeur numérique
$id = intval($id);

// 1 - Isoler tous les ID des membres dans un tableau
// Ce tableau sera donc "mis à plat"
$membersIds = array_column($members, 'id');
// 2 - Je recherche l'ID fourni en paramètre GET
// dans le tableau de tous les ID
$memberKey = array_search($id, $membersIds);

if ($memberKey === false) {
    http_response_code(404);
    echo "Membre non trouvé";
    exit;
}

// Si j'arrive à ce niveau du code, cela signifie que
// l'ID a été trouvé dans le tableau d'IDs, donc que mon utilisateur
// a été trouvé
$member = $members[$memberKey];

?>

<main class="prose mx-auto">
  <div class="flex w-full justify-between align-top w-[120px] h-[120px]">
    <h1><?php echo getFullName($member, FIRSTNAME_THEN_NAME); ?></h1>
    <img class="m-0 rounded-full" src="<?php echo $member['picture']; ?>" alt="<?php echo getFullName($member, FIRSTNAME_THEN_NAME); ?>" />
  </div>
  <blockquote>
    <?php echo $member['quote']; ?>
  </blockquote>
  <h2>Compétences :</h2>
  <div class="flex gap-3">
  <?php
  foreach ($member['abilities'] as $abilityId) {
      $ability = findAbility($abilities, $abilityId);
      ?>
    <div class="bg-[<?php echo $ability['bgColor'];?>] text-white px-2 py-1">
      <?php echo strtoupper($ability['name']); ?>
    </div>
      <?php
  }
?>
  </div>
  
</main>

<?php require_once 'layout/footer.php';