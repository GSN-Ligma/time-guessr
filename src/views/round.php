<?php
$roundNumber = $_GET['n'] ?? 1;

$query = $pdo->query("SELECT * FROM rounds ORDER BY RAND() LIMIT 1");

// 3. On récupère les données (sous forme de tableau associatif)
$roundData = $query->fetch();

if ($roundNumber === 1) {

    $_SESSION['totalScore'] = 0;
    
    $query = $pdo->query("SELECT id FROM rounds ORDER BY RAND() LIMIT 5");
    $_SESSION['game_rounds'] = $query->fetchAll(PDO::FETCH_COLUMN);
}

echo "Time Guesoeur !";
?>
<link rel="stylesheet" href="css/style.css">
<h1>Round <?= $roundNumber ?> sur 5</h1>

<img src="<?= $roundData['image_path'] ?>" alt="Photo à deviner" style="max-width: 500px;">

<br>
<p>où et en quelle année et a été prise cette photo ?</p>
<div id="map"></div>
<form action="index.php?page=round-results&n=<?= $roundNumber ?>" method="POST">
    
    <input type="number" name="user_guess" required min="1800" max="2026">

    <input type="hidden" name="photo_id" value="<?= $roundData['id'] ?>"> 
    <input type="hidden" name="lat" id="lat">
    <input type="hidden" name="lng" id="lng">

    <button type="submit" id="submit-btn">Valider</button>
</form>


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" /> 
<style>
    #map { height: 400px; width : 600px;}
</style>
// 


<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Initialisation de la carte
    const map = L.map('map').setView([0, 0], 1);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

    let marker;

    // Détecter le clic sur la carte
    map.on('click', function(e) {
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;

        // Si un marqueur existe déjà, on le déplace, sinon on le crée
        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }

        // On remplit les inputs cachés pour PHP
        document.getElementById('lat').value = lat;
        document.getElementById('lng').value = lng;
    });
</script>


<br>
<a href="index.php?page=game-over">Rénitialiser partie</a>