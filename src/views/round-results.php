<?php

/**
 * home page
 * 
 */

$roundNumber = $_GET['n'] ?? 1;
$userGuess = (int)($_POST['user_guess'] ?? 0);

$ResultYear = 1985;

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
