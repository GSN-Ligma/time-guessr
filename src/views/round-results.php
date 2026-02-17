<?php

/**
 * home page
 * 
 */

$roundNumber = $_GET['n'] ?? 1;

$photoId = (int)($_POST['photo_id'] ?? 0); // on récupère l'id cacher envoyer par le formulaire

// on recupère ce que l'utilisateur à entré : 
$userGuess = (int)($_POST['user_guess'] ?? 0);
$userLat = $_POST['lat'] ?? null; // ici on recup les valeur cacher (co) du formulaire
$userLng = $_POST['lng'] ?? null;


// On récupère les vraies infos en DB
$query = $pdo->prepare("SELECT true_year, latitude, longitude FROM rounds WHERE id = :id");


// 2. On exécute en passant la valeur (on prend l'id de la photo qu'on à recup plus haut)
$query->execute(['id' => $photoId]);

// 3. On récupère les données (sous forme de tableau associatif)
$roundData = $query->fetch();

$ResultYear = $roundData['true_year'];

$ResultLat = $roundData['latitude'];
$ResultLong = $roundData['longitude'];

// je calcul la distance entre les 2 : 
// voir : https://www.omnicalculator.com/fr/autre/calculateur-distance-latitude-longitude
// la formule est : d = 2R × sin⁻¹(√[sin²((θ₂ - θ₁)/2) + cosθ₁ × cosθ₂ × sin²((φ₂ - φ₁)/2)]
// θ₁ et φ₁ sont la latitude et longitude du point 1
// θ₂ et φ₂ sont la latitude et longitude du point 2
// R = 6 371 km (rayon de la terre)

$R = 6371;

// on passe en radian car les sin et cos on besoin de rad (la fonction deg2rad fait directement ça)
$degre_userLat = deg2rad($userLat);
$degre_ResultLat = deg2rad($ResultLat);

// on prend directement la différence : 
$dLat = deg2rad($ResultLat - $userLat);
$dLon = deg2rad($ResultLong - $userLng);

// on fait la formule de Haversines (la partie "sin²")
$a = sin($dLat / 2) * sin($dLat / 2) + cos($degre_userLat) * cos($degre_ResultLat) * sin($dLon / 2) * sin($dLon / 2);

$distance = 2.0*$R*asin($a**0.5); //exposant 0.5 = racine


$datepoint = 5000 - (250 *abs($userGuess - $ResultYear));

if ($datepoint < 0) {
    $datepoint = 0;
}

$distancepoint = 5000 - (3/5*$distance);

if ($distancepoint < 0) {
    $distancepoint = 0;
}

$_SESSION['totalScore']  = $_SESSION['totalScore'] + $datepoint + $distancepoint;

?>
<link rel="stylesheet" href="css/style.css">
<h1>round result <?= $roundNumber ?> sur 5</h1>


<?php if ($roundNumber < 5): ?>
    <a href="index.php?page=round&n=<?= $roundNumber +1 ?>">Round suivant</a>
<?php else: ?>
    <a href="index.php?page=game-over">Voir le score final</a>
<?php endif; ?>


<h2>Vous avez indiquer <?= $userGuess ?>, la vrai réponse était <?= $ResultYear ?></h2>
<h2>distance : <?=(int) $distance ?> km </h2>

<br>
<p>score distance : <?= (int) $distancepoint ?> point sur 5000</p>
<p>score date : <?= $datepoint ?> point sur 5000</p>

<br>
<p>total score : <?= (int) $_SESSION['totalScore'] ?> point </p>


<br>
<p>vous avez indiqué : latitude : <?= $userLat ?> longitude :  <?= $userLng ?></p>
<p>la bonne réponse est : latitude : <?= $ResultLat ?> longitude :  <?= $ResultLong ?></p>

<br>
<a href="index.php?page=game-over">Rénitialiser partie</a>