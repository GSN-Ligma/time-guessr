<?php

/**
 * home page
 * 
 */

$roundNumber = $_GET['n'] ?? 1;
$userGuess = (int)($_POST['user_guess'] ?? 0);

// 1. On prépare la requête avec un "marqueur" (:id)
$query = $pdo->prepare("SELECT * FROM rounds WHERE id = :id");

// 2. On exécute en passant la valeur
$query->execute(['id' => $roundNumber]);

// 3. On récupère les données (sous forme de tableau associatif)
$roundData = $query->fetch();

$ResultYear = $roundData['true_year'];

$point = 5000 - (250 *abs($userGuess - $ResultYear));


if ($point < 0) {
    $point = 0;
}

$_SESSION['totalScore'] = $_SESSION['totalScore'] + $point;

?>
<h1>round result <?= $roundNumber ?> sur 5</h1>


<?php if ($roundNumber < 5): ?>
    <a href="index.php?page=round&n=<?= $roundNumber +1 ?>">Round suivant</a>
<?php else: ?>
    <a href="index.php?page=game-over">Voir le score final</a>
<?php endif; ?>


<p>Vous avez indiquer <?= $userGuess ?>, la vrai réponse était <?= $ResultYear ?></p>
<p>Vous avez : <?= $point ?> point sur 5000</p>

<p>total score : <?= $_SESSION['totalScore'] ?> point </p>
