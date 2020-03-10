<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$saved = " ";
$marksFilename = 'marks.txt';
if (isset($_GET['submitted'])) {
    if (!file_exists($marksFilename) or !is_readable($marksFilename)) {
        $errorMessage = "Nepavyksta atidaryti failo su mokinių pažymiais!";
        include 'errorTemplate.php';
        exit();
    }
    $studentMark = $_GET['student']." ".$_GET['subject']." ".$_GET['mark']."\n";
    file_put_contents($marksFilename, $studentMark, FILE_APPEND);
    $saved = "Išsaugota";
}
@$marksFile = fopen(@$marksFilename, "r");
if (!file_exists($marksFilename) or !is_readable($marksFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo su mokinių pažymiais!";
    include 'errorTemplate.php';
    exit();
}   
    $peopleFilename = 'people.txt';
@$peopleFile = fopen(@$peopleFilename, "r");
if (!file_exists($peopleFilename) or !is_readable($peopleFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo su mokinių sąrašu!";
    include 'errorTemplate.php';
    exit();
}
$studentOptions = "";
for ($line = fgets($peopleFile); !feof($peopleFile); $line = fgets($peopleFile)) {
    $studentOptions .= "<option>{$line}</option>";
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
        <form action = '' method = 'get'>
            <div>Mokinys:</div>
            <div>
                <select name = 'student'>
                    <?= $studentOptions ?>
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