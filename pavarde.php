<!DOCTYPE html>
<html lang="lt">
<head>
<title>Vardai ir Pavardės</title>
</head>
<body>
<?php
$filename = 'students.csv';
if (empty($_GET['vardas']) or empty($_GET['pavarde'])) {
    ?>
<h2>Įrašykite savo duomenis</h2>
<form method="get">
Vardas:<br>
<input type="text" name="vardas" value="Vardenis">
<br>
Vardas:<br>
<input type="text" name="vardas2" value="Vardenis">
<br>
Pavardė:<br>
<input type="text" name="pavarde" value="Pavardenis">
<br>
<input type="submit" value="Išsaugoti">
</form>
    <?php
} else {
    $duomenys = $_GET['vardas'].",".$_GET['vardas2'].",".$_GET['pavarde']."\n";
    file_put_contents($filename, $duomenys, FILE_APPEND);
    echo "Išsaugota";
}
?>
</body>
</html>