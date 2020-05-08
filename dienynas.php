<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$marksFilename = 'marks.csv';
if (!file_exists($marksFilename) or !is_writable($marksFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo rašymui su mokinių pažymiais!";
    include 'errorTemplate.php';
    exit();
}
$studentsFilename = 'students.csv';
if (!file_exists($studentsFilename) or !is_readable($studentsFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo skaitymui su mokinių sąrašu!";
    include 'errorTemplate.php';
    exit();
}

$saved = "";
$studentNumber = "";
$studentName = "";
$studentSurname = "";
if (isset($_POST['student']) and isset($_POST['subject']) and isset($_POST['mark']) and isset($_POST['notes'])) {
    $studentsFile = fopen($studentsFilename, "r");
    while (($studentData = fgetcsv($studentsFile, ",")) !== FALSE) {
        if ($studentData[0] === $_POST['student']) {
            $studentName = $studentData[2];
            $studentSurname = $studentData[1];
            $studentNumber = $studentData[0];
        } 
    }
    fclose($studentsFile);
    $studentMark = [$studentNumber, $_POST['subject'], $_POST['mark'], $_POST['notes']];
    $marksFile = fopen($marksFilename, 'a');
    fputcsv($marksFile, $studentMark);
    $saved = "Išsaugota";
    fclose($marksFile);
}

$studentOptions = "";
$studentsFile = fopen($studentsFilename, "r");
if ($studentsFile !== FALSE) {
    while (($studentData = fgetcsv($studentsFile, ",")) !== FALSE) {
        $studentOptions .= "<option value = '$studentData[0]'>{$studentData[2]} {$studentData[1]} </option>";
    }
    fclose($studentsFile);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang = "lt">
    <head>
        <title>Naujo pažymio įvedimas</title>
    </head>
    <body>
        <p><?= $saved?></p>
        <h2>Įrašykite pažymį</h2>
        <form action = '' method = 'post'>
            <div>Mokinys:</div>
            <div>
                <select name = 'student'>
                    <?= $studentOptions?>
                </select>
            </div>
            <div>Dalykas:</div>
            <div><input type = 'text' name = 'subject' value = "Matematika"></div>
            <div>Pažymys:</div>
            <div><input type = 'text' name = 'mark' value = "7"></div>
            <div>Pastabos, komentarai:</div>
            <div><textarea rows = "5" cols = "50" name = "notes"></textarea></div>
            <div><input type = 'submit' value = "Išsaugoti"></div>
        </form>
    </body>
</html>