<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$marksFilename = 'marksTable.php';
@$marksFile = fopen(@$marksFilename, "r");
if (!file_exists($marksFilename) or !is_readable($marksFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo su mokinių pažymiais!";
    include 'errorTemplate.php';
    exit();
}
@$peopleFile = fopen(@$peopleFilename, "r");
$peopleFilename = 'people.txt';
if (!file_exists($peopleFilename) or !is_readable($peopleFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo su mokinių sąrašu!";
    include 'errorTemplate.php';
    exit();
}

$studentOptions = "";
@$peopleFile = fopen(@$peopleFilename, "r");
$peopleFilename = 'people.txt';

for ($line = fgets($peopleFile); !feof($peopleFile); $line = fgets($peopleFile)) {
    $studentOptions .= "<option>{$line}</option>";
}
$saved = " ";
if (isset($_POST['submitted'])) {
    for ($i = 1; $i< ; $i++) {
        $nameSurname = explode(" ", $_POST['student']);
        $studentMarkData = "<tr><td>".$i."</td><td>".$nameSurname[0]."</td>"."<td>".$nameSurname[1]."</td>"."<td>".$_POST['subject']."</td>"."<td>".$_POST['mark']."</td></tr>";
        file_put_contents($marksFilename, $studentMarkData, FILE_APPEND);
        $saved = "Išsaugota";
    }
}
if (isset ($_POST['studentMarksTable'])) {
    $tableEnding = "</table></body></html>";
    file_put_contents($marksFilename, $tableEnding, FILE_APPEND);
    include 'marksTable.php';
    exit();
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
        <form action = 'marksTable.php' method = 'post'>
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
            <div><input type = 'submit' name = 'studentMarksTable' value = "Peržiūrėti pažymius"></div>
        </form>
    </body>
</html>