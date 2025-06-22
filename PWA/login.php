<?php
session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'vijesti';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Greška: " . $conn->connect_error);
$sql = "SELECT * FROM vijesti WHERE prikazati = 'Da' ORDER BY kategorija";
$result = $conn->query($sql);

$kategorije = [];
$poruka;

while ($row = $result->fetch_assoc()) {
    $kat = $row['kategorija'];
    $kategorije[$kat][] = $row;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['lozinka'];

    $stmt = $conn->prepare("SELECT * FROM korisnik WHERE korisnicko_ime = ?");
    $stmt->bind_param("s", $korisnicko_ime);
    $stmt->execute();
    $rez = $stmt->get_result();

    if ($rez->num_rows === 1) {
        $korisnik = $rez->fetch_assoc();
        if (password_verify($lozinka, $korisnik['lozinka'])) {
            $_SESSION['korisnicko_ime'] = $korisnik['korisnicko_ime'];
            $_SESSION['admin'] = $korisnik['admin'];

            if ($korisnik['admin'] == 1) {
                header("Location: administrator.php");
                exit;
            } else {
                echo "Pozdrav, " . htmlspecialchars($korisnicko_ime) . ". Nemaš pristup administraciji.";
                exit;
            }
        } else {
            $poruka = "Pogrešna lozinka.";
        }
    } else {
        $poruka = "Korisnik ne postoji.";
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Prijava</title>
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
</header>
<section class="prijava">
    <h2>Prijava</h2>
    <?php if (!empty($poruka)): ?>
        <p class="poruka"><?= $poruka ?></p>
    <?php endif; ?>
    <form method="post" action="login.php">
        <label>Korisničko ime:<br><input type="text" name="korisnicko_ime" required></label><br><br>
        <label>Lozinka:<br><input type="password" name="lozinka" required></label><br><br>
        <button type="submit">Prijavi se</button>
    </form>
    <p>Nemate račun? <a href="registracija.php">Registrirajte se</a></p>
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