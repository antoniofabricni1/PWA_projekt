<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'vijesti';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Greška pri spajanju: " . $conn->connect_error);

$sql = "SELECT * FROM vijesti WHERE prikazati = 'Da' ORDER BY kategorija";
$result = $conn->query($sql);

$kategorije = [];

while ($row = $result->fetch_assoc()) {
    $kat = $row['kategorija'];
    $kategorije[$kat][] = $row;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $conn->prepare("SELECT * FROM vijesti WHERE id = ? AND prikazati = 'Da'");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p>Članak nije pronađen.</p>";
    exit;
}

$clanak = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($clanak['naslov']) ?></title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
    <nav>
        <div id="logo"><img src="img/logo-sopitas.webp" alt=""></div>
        <div id="navigacija">
            <a href="index.php">Home</a>
            <?php foreach (array_keys($kategorije) as $k): ?>
                <a href="kategorija.php?kategorija=<?= urlencode($k) ?>"><?= htmlspecialchars($k) ?></a>
            <?php endforeach; ?>
            <a href="unos.php">Nova vijest</a>
            <a href="login.php">Prijava</a>
        </div>
    </nav>
</header>

    <section id="clanakStr">
        <div class="cslika" id="clanakSlika">
            <img id="slikaVijest" src="uploads/<?= htmlspecialchars($clanak['slika']) ?>" alt="">
        </div>
        <h2 id="naslov"><?= htmlspecialchars($clanak['naslov']) ?></h2>
        <h6 id="kat"><?= htmlspecialchars($clanak['kategorija']) ?></h6>
        <p id="saz"><?= htmlspecialchars($clanak['sazetak']) ?></p>
        <p id="txt"><?= nl2br(htmlspecialchars($clanak['tekst'])) ?></p>
    </section>
<footer>
        <section id="kontakt">
        <p>Antonio Fabrični</p>
        <a href="mailto:afabricni@tvz.hr">afabricni@tvz.hr</a>
        <p>2025.</p>
        </section>
    </footer>
</body>
</html>