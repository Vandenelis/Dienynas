<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$marksFilename = 'marks.csv';
if (!file_exists($marksFilename) or !is_writable($marksFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo rašymui su mokinių pažymiais!";
    include 'errorTemplate.php';
    exit();
}

$saved = "";
if (isset($_POST['student']) and isset($_POST['subject']) and isset($_POST['mark']) and isset($_POST['notes'])) {
    $studentMark = [$_POST['student'], $_POST['subject'], $_POST['mark'], $_POST['notes']];
    $marksFile = fopen($marksFilename, 'a');
    fputcsv($marksFile, $studentMark);
    $saved = "Išsaugota";
    fclose($marksFile);
}

$studentsFilename = 'students.csv';
include 'studentsFile.php';
$studentOptions = "";
$studentsArray = getAllStudentsAsArray();
foreach ($studentsArray as $student) {
    $studentOptions .= "<option value = '$student[0]'>{$student[2]} {$student[1]}</option>";
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