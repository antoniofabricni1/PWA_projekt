<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'vijesti';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Greška: " . $conn->connect_error);

$sql = "SELECT * FROM vijesti WHERE prikazati = 'Da' ORDER BY kategorija";
$result = $conn->query($sql);

$kategorije = [];

while ($row = $result->fetch_assoc()) {
    $kat = $row['kategorija'];
    $kategorije[$kat][] = $row;
}

$greska = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = password_hash($_POST['lozinka'], PASSWORD_BCRYPT);
    $admin = isset($_POST['admin']) ? 1 : 0;

    $stmt = $conn->prepare("SELECT id FROM korisnik WHERE korisnicko_ime = ?");
    $stmt->bind_param("s", $korisnicko_ime);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $greska = "Korisničko ime '$korisnicko_ime' je već zauzeto.";
    } else {
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO korisnik (korisnicko_ime, lozinka, admin) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $korisnicko_ime, $lozinka, $admin);
        if ($stmt->execute()) {
            echo "Registracija uspješna. <a href='login.php'>Prijavi se</a>";
            exit;
        } else {
            $greska = "Došlo je do greške prilikom registracije.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Registracija</title>
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
<section class="prijava">
    <h2>Registracija korisnika</h2>

    <?php if (!empty($greska)): ?>
        <p class="poruka"><?= $greska ?></p>
    <?php endif; ?>

    <form action="registracija.php" method="post">
        <label>Korisničko ime:<br><input type="text" name="korisnicko_ime" required></label><br><br>
        <label>Lozinka:<br><input type="password" name="lozinka" required></label><br><br>
        <label><input type="checkbox" name="admin"> Administratorska prava</label><br><br>
        <button type="submit">Registriraj</button>
    </form>
    <p>Već imaš račun? <a href="login.php">Prijavi se</a></p>
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