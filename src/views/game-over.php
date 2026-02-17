<?php

/**
 * fin de partie
 * 
 */


echo "Time guessr ! Partie terminée, score final";



?>

<a href="index.php?page=home">Home page</a>

<p>total score : <?= (int) $_SESSION['totalScore'] ?> point sur 50 000</p>

<?= $_SESSION['totalScore'] = 0 ?>