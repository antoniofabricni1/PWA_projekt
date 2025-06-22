<?php
session_start();
if (!isset($_SESSION['korisnicko_ime'])) {
    die("Pristup zabranjen. <a href='login.php'>Prijavi se</a>");
}
if ($_SESSION['admin'] != 1) {
    die("Nemate administratorska prava.");
}

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

if (isset($_GET['obrisi'])) {
    $id = (int)$_GET['obrisi'];
    $conn->query("DELETE FROM vijesti WHERE id = $id");
    header("Location: administrator.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["azuriraj"])) {
    $id = (int)$_POST['id'];
    $naslov = $_POST['naslov'];
    $sazetak = $_POST['sazetak'];
    $tekst = $_POST['tekst'];
    $kategorija = $_POST['kategorija'];
    $prikazati = isset($_POST['prikazati']) ? 'Da' : 'Ne';

    $rezSlika = $conn->prepare("SELECT slika FROM vijesti WHERE id = ?");
    $rezSlika->bind_param("i", $id);
    $rezSlika->execute();
    $rezSlika->bind_result($staraSlika);
    $rezSlika->fetch();
    $rezSlika->close();

    $slikaIme = $staraSlika;

    if (isset($_FILES['slika']) && $_FILES['slika']['error'] === 0) {
        $slikaIme = basename($_FILES['slika']['name']);
        $slikaTmp = $_FILES['slika']['tmp_name'];
        $slikaDest = "uploads/" . $slikaIme;

        if (!is_dir("uploads")) {
            mkdir("uploads", 0777, true);
        }

        move_uploaded_file($slikaTmp, $slikaDest);
    }

    $stmt = $conn->prepare("UPDATE vijesti SET naslov=?, sazetak=?, tekst=?, kategorija=?, prikazati=?, slika=? WHERE id=?");
    $stmt->bind_param("ssssssi", $naslov, $sazetak, $tekst, $kategorija, $prikazati, $slikaIme, $id);
    $stmt->execute();   
    $stmt->close();

    header("Location: administrator.php");
    exit;
}

$vijesti = $conn->query("SELECT * FROM vijesti ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Administracija vijesti</title>
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

<section class="admin odmicanje">
<h1>Administracija vijesti</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Naslov</th>
        <th>Kategorija</th>
        <th>Prikazati</th>
        <th>Slika</th>
        <th>Uredi / Obriši</th>
    </tr>
    <?php while ($v = $vijesti->fetch_assoc()): ?>
    <tr>
        <td><?= $v['id'] ?></td>
        <td><?= htmlspecialchars($v['naslov']) ?></td>
        <td><?= htmlspecialchars($v['kategorija']) ?></td>
        <td><?= $v['prikazati'] ?></td>
        <td><img src="uploads/<?= $v['slika'] ?>" alt="" width="100"></td>
        <td class="akcije">
            <a href="administrator.php?uredi=<?= $v['id'] ?>">Uredi</a>
            <a href="administrator.php?obrisi=<?= $v['id'] ?>" onclick="return confirm('Jeste li sigurni?')">Obriši</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</section>

<?php
if (isset($_GET['uredi'])):
    $id = (int)$_GET['uredi'];
    $rez = $conn->query("SELECT * FROM vijesti WHERE id = $id");
    $clanak = $rez->fetch_assoc();
?>
<section class="admin">
<h2>Uredi vijest ID: <?= $clanak['id'] ?></h2>
<form method="post" action="administrator.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $clanak['id'] ?>">
    <label>Naslov:<br>
        <input type="text" name="naslov" value="<?= htmlspecialchars($clanak['naslov']) ?>">
    </label><br><br>
    <label for="kategorija">Kategorija vijesti:</label>
    <select id="kategorija" name="kategorija" required>
        <option value="">-- Odaberite kategoriju --</option>
        <option value="sport" <?= $clanak['kategorija'] == 'sport' ? 'selected' : '' ?>>Sport</option>
        <option value="tehnologija" <?= $clanak['kategorija'] == 'tehnologija' ? 'selected' : '' ?>>Tehnologija</option>
    </select>
    <br><br>
    <label>Kratki sažetak:<br>
        <textarea name="sazetak"><?= htmlspecialchars($clanak['sazetak']) ?></textarea>
    </label><br><br>
    <label>Tekst vijesti:<br>
        <textarea name="tekst"><?= htmlspecialchars($clanak['tekst']) ?></textarea>
    </label><br><br>
    <p>Trenutna slika:<br>
        <img src="uploads/<?= htmlspecialchars($clanak['slika']) ?>" width="150">
    </p>
        <input type="file" name="slika">
    </label><br><br>
    <label>
        <input type="checkbox" name="prikazati" <?= $clanak['prikazati'] === 'Da' ? 'checked' : '' ?>>
        Prikazati na stranici
    </label><br><br>
    <button type="submit" name="azuriraj">Spremi promjene</button>
</form>
</section>
<?php endif; ?>

<footer>
        <section id="kontakt">
        <p>Antonio Fabrični</p>
        <a href="mailto:afabricni@tvz.hr">afabricni@tvz.hr</a>
        <p>2025.</p>
        </section>
    </footer>
</body>
</html>