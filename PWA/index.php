<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'vijesti';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Greška pri spajanju: " . $conn->connect_error);

$sql = "SELECT * FROM vijesti WHERE prikazati = 'Da' ORDER BY kategorija";
$result = $conn->query($sql);

$kategorije = [];

while ($row = $result->fetch_assoc()) {
    $kat = $row['kategorija'];
    $kategorije[$kat][] = $row;
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Naslovna</title>
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

<?php foreach ($kategorije as $kategorija => $vijesti): ?>
<section>
    <div class="naslov">
        <h3 style="background-color: <?= ($kategorija == 'tehnologija' ? 'limegreen' : 'hotpink') ?>;">
            <?= htmlspecialchars($kategorija) ?>
        </h3>
        <hr style="border-bottom-color: <?= ($kategorija == 'tehnologija' ? 'limegreen' : 'hotpink') ?>;">
    </div>
    <div class="clanci">
        <?php foreach ($vijesti as $v): ?>
        <article onclick="clanak.php?id=<?= $v['id'] ?>" class="clanak">
            <div class="cslika">
                <a href="clanak.php?id=<?= $v['id'] ?>"><img src="uploads/<?= htmlspecialchars($v['slika']) ?>" alt=""></a>
            </div>
                <h4>
                    <a href="clanak.php?id=<?= $v['id'] ?>">
                          <?= htmlspecialchars($v['naslov']) ?>
                     </a>
                </h4>
           <a href="clanak.php?id=<?= $v['id'] ?>"><p><?= htmlspecialchars($v['sazetak']) ?></p></a>
        </article>
        <?php endforeach; ?>
    </div>
</section>
<?php endforeach; ?>
<footer>
        <section id="kontakt">
        <p>Antonio Fabrični</p>
        <a href="mailto:afabricni@tvz.hr">afabricni@tvz.hr</a>
        <p>2025.</p>
        </section>
    </footer>
</body>
</html>