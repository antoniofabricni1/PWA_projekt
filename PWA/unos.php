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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova vijest</title>
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
    <section class="odmicanje">
        <h1>Unos novih vijesti:</h1>
        <form id="unos" action="skripta.php" method="post" enctype="multipart/form-data">
  <label for="naslov">Naslov vijesti:</label>
  <input type="text" id="naslov" name="naslov" required>

  <label for="sazetak">Kratki sažetak vijesti:</label>
  <textarea id="sazetak" name="sazetak" rows="3" required></textarea>

  <label for="tekst">Tekst vijesti:</label>
  <textarea id="tekst" name="tekst" rows="6" required></textarea>

  <label for="kategorija">Kategorija vijesti:</label>
  <select id="kategorija" name="kategorija" required>
    <option value="">-- Odaberite kategoriju --</option>
    <option value="sport">Sport</option>
    <option value="tehnologija">Tehnologija</option>
  </select>

  <label for="slika">Odaberite sliku:</label>
  <input type="file" id="slika" name="slika" accept="image/*" required>

  <div>
    <input type="checkbox" id="prikazi" name="prikazi" value="da">
    <label for="prikazi">Prikazati vijest na stranici</label>
  </div>

  <input type="submit" value="Pošalji vijest">
</form>
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
