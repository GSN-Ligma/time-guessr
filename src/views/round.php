<?php

/**
 * home page
 * 
 */
$roundNumber = $_GET['n'] ?? 1;

// 1. On prépare la requête avec un "marqueur" (:id)
$query = $pdo->prepare("SELECT * FROM rounds WHERE id = :id");

// 2. On exécute en passant la valeur
$query->execute(['id' => $roundNumber]);

// 3. On récupère les données (sous forme de tableau associatif)
$roundData = $query->fetch();
echo "Time guessr ! round page";

?>
<h1>Round <?= $roundNumber ?> sur 5</h1>

<img src="<?= $roundData['image_path'] ?>" alt="Photo à deviner" style="max-width: 500px;">

<br>
<p>réponse :</p>
<form action="index.php?page=round-results&n=<?= $roundNumber ?>" method="POST">
    <p>En quelle année cette photo a-t-elle été prise ?</p>
    <input type="number" name="user_guess" required min="1800" max="2026">
    <button type="submit">Valider</button>
</form>

