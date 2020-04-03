<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$marksFilename = 'marks.txt';
@$marksFile = fopen(@$marksFilename, "r");
if (!file_exists($marksFilename) or !is_writable($marksFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo su mokinių pažymiais!";
    include 'errorTemplate.php';
    exit();
}
@$peopleFile = fopen(@$peopleFilename, "r");
$peopleFilename = 'students.csv';
if (!file_exists($peopleFilename) or !is_readable($peopleFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo su mokinių sąrašu!";
    include 'errorTemplate.php';
    exit();
}
$saved = " ";
if (isset($_POST['student']) and isset($_POST['subject']) and isset($_POST['mark'])) {
    $studentMark = $_POST['student'].",".$_POST['subject'].",".$_POST['mark']."\n";
    $studentMark = str_replace("\r\n", "", $studentMark);
    file_put_contents($marksFilename, $studentMark, FILE_APPEND);
    $saved = "Išsaugota";
}
$studentOptions = " ";
@$peopleFile = fopen(@$peopleFilename, "r");
for ($line = fgets($peopleFile); !feof($peopleFile); $line = fgets($peopleFile)) { 
    $names = explode(",", $line);
    $studentOptions .= "<option value = '$names[0],$names[1]'>{$names[0]} {$names[1]}</option>";
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
            <div><input type = 'submit' name = 'submitted' value = "Išsaugoti"></div>
        </form>
    </body>
</html>