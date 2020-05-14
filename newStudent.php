<?php
$studentsFilename = 'students.csv';
if (file_exists($studentsFilename) and (!is_writable($studentsFilename) or !is_readable($studentsFilename))) {
    $errorMessage = "Nepavyksta atidaryti failo su mokinių sąrašu rašymui arba skaitymui!";
    include 'errorTemplate.php';
    exit();
}
$saved = "";
$studentNumberMessage = "";    
if (!empty($_POST['vardas']) and !empty($_POST['pavarde']) and !empty($_POST['numeris'])) {
    if (file_exists($studentsFilename)) {
        $studentsFile = fopen($studentsFilename, "r");
        while (($studentData = fgetcsv($studentsFile, ",")) !== FALSE) {
            if ($studentData[0] === $_POST['numeris']) {
                $studentNumberMessage = "Toks mokinio numeris jau panaudotas, įveskite kitą skaičių.";
            }
        }
        fclose($studentsFile);
    }
    if (empty($studentNumberMessage)) {
        $duomenys = [$_POST['numeris'], $_POST['pavarde'], $_POST['vardas']];
        $studentsFile = fopen($studentsFilename, 'a');//jei failo nėra, tai jis bus sukurtas
        fputcsv($studentsFile, $duomenys);
        fclose($studentsFile);
        $saved = "Išsaugota"; 
    }
}
?>
<!DOCTYPE html>
<html lang="lt">
    <head>
        <title>Vardai ir Pavardės</title>
    </head>
    <body>
        <p><?= $studentNumberMessage?></p>
        <p><?= $saved?></p>
        <h2>Įrašykite naujo mokinio duomenis</h2>
        <form method="post">
Vardas:<br>
            <input type="text" name="vardas" value="Vardenis">
            <br>
Pavardė:<br>
            <input type="text" name="pavarde" value="Pavardenis">
            <br>
Mokinio numeris:<br>
            <input type="text" name="numeris" value="12345">
            <br>
            <input type="submit" value="Išsaugoti">
        </form>
    </body>
</html>