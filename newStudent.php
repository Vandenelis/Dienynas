<!DOCTYPE html>
<html lang="lt">
<head>
<title>Vardai ir Pavardės</title>
</head>
<body>
<?php
$filename = 'students.csv';
if (empty($_GET['vardas']) or empty($_GET['pavarde']) or empty($_GET['numeris'])) {
    ?>
<h2>Įrašykite naujo mokinio duomenis</h2>
<form method="get">
Vardas:<br>
<input type="text" name="vardas" value="Vardenis">
<br>
Vardas:<br>
<input type="text" name="vardas2" value="">
<br>
Pavardė:<br>
<input type="text" name="pavarde" value="Pavardenis">
<br>
Mokinio numeris:<br>
<input type="text" name="numeris" value="12345">
<br>
<input type="submit" value="Išsaugoti">
</form>
    <?php
} else {
    $duomenys = $_GET['vardas'].",".$_GET['vardas2'].",".$_GET['pavarde'].",".$_GET['numeris']."\n";
    file_put_contents($filename, $duomenys, FILE_APPEND);
    echo "Išsaugota";
}
?>
</body>
</html>