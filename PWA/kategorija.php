<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'vijesti';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Greška pri spajanju: " . $conn->connect_error);

$kategorija = isset($_GET['kategorija']) ? $_GET['kategorija'] : '';

$sql = "SELECT * FROM vijesti WHERE prikazati = 'Da' ORDER BY kategorija";
$result = $conn->query($sql);

$kategorije = [];

while ($row = $result->fetch_assoc()) {
    $kat = $row['kategorija'];
    $kategorije[$kat][] = $row;
}
$stmt = $conn->prepare("SELECT * FROM vijesti WHERE prikazati = 'Da' AND kategorija = ?");
$stmt->bind_param("s", $kategorija);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($kategorija) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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

<section>
    <div class="naslov">
        <h3 style="background-color: <?= ($kategorija == 'tehnologija' ? 'limegreen' : 'hotpink') ?>;">
            <?= htmlspecialchars($kategorija) ?>
        </h3>
        <hr style="border-bottom-color: <?= ($kategorija == 'tehnologija' ? 'limegreen' : 'hotpink') ?>;">
    </div>
    <div class="clanci">
        <?php while ($v = $result->fetch_assoc()): ?>
        <article class="clanak">
            <div class="cslika">
                <img src="uploads/<?= htmlspecialchars($v['slika']) ?>" alt="">
            </div>
            <h4>
                    <a href="clanak.php?id=<?= $v['id'] ?>">
                          <?= htmlspecialchars($v['naslov']) ?>
                     </a>
                </h4>
            <a href="clanak.php?id=<?= $v['id'] ?>"><p><?= htmlspecialchars($v['sazetak']) ?></p></a>
        </article>
        <?php endwhile; ?>
    </div>
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