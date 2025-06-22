<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naslov = htmlspecialchars($_POST["naslov"]);
    $sazetak = htmlspecialchars($_POST["sazetak"]);
    $tekst = htmlspecialchars($_POST["tekst"]);
    $kategorija = htmlspecialchars($_POST["kategorija"]);
    $prikazi = isset($_POST["prikazi"]) ? "Da" : "Ne";

    $slikaInfo = "";
    $slikaIme = "";

    if (isset($_FILES["slika"]) && $_FILES["slika"]["error"] == 0) {
        $slikaIme = basename($_FILES["slika"]["name"]);
        $slikaTmp = $_FILES["slika"]["tmp_name"];
        $slikaDest = "uploads/" . $slikaIme;

        if (!is_dir("uploads")) {
            mkdir("uploads", 0777, true);
        }

        if (move_uploaded_file($slikaTmp, $slikaDest)) {
            $slikaInfo = "<p><strong>Slika:</strong><br><img src='$slikaDest' alt='Slika vijesti' style='max-width:300px;'></p>";
        } else {
            $slikaInfo = "<p>Greška pri prijenosu slike.</p>";
        }
    } else {
        $slikaInfo = "<p>Nije poslana slika.</p>";
    }

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db   = 'vijesti';

    $conn = new mysqli($host, $user, $pass, $db);

    if (!$conn->connect_error) {
        $stmt = $conn->prepare("INSERT INTO vijesti (naslov, sazetak, tekst, kategorija, slika, prikazati) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $naslov, $sazetak, $tekst, $kategorija, $slikaIme, $prikazi);
        $stmt->execute();

        $novi_id = $conn->insert_id;

        $stmt->close();
        $conn->close();

        header("Location: clanak.php?id=" . $novi_id);
        exit;
    }
}
?>