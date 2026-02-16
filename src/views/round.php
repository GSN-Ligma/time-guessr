<?php

/**
 * home page
 * 
 */
$roundNumber = $_GET['n'] ?? 1;

echo "Time guessr ! round page";

?>
<h1>Round <?= $roundNumber ?> sur 5</h1>

<br>
<p>réponse :</p>
<form action="index.php?page=round-results&n=<?= $roundNumber ?>" method="POST">
    <p>En quelle année cette photo a-t-elle été prise ?</p>
    <input type="number" name="user_guess" required min="1800" max="2026">
    <button type="submit">Valider</button>
</form>

