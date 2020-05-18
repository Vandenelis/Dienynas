<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$marksFilename = 'marks.csv';
if (!file_exists($marksFilename) or !is_readable($marksFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo su mokinių pažymiais skaitymui!";
    include 'errorTemplate.php';
    exit();
}
$studentsFilename = 'students.csv';
include 'studentsFile.php';
students("");

$studentData = "";
$i = 0;
$studentsCount = 0;
$marksFile = fopen($marksFilename, "r");
$studentsFile = fopen($studentsFilename, "r");
$studentsArray = [];
while(($studentDataLine = fgetcsv($studentsFile, ",")) !== FALSE){
    $studentsArray[] = $studentDataLine;
}
while(($studentMarksDataLine = fgetcsv($marksFile, ",")) !== FALSE){
    foreach ($studentsArray as $student) {
         if ($student[0] === $studentMarksDataLine[0]) {
            $i++;
            $studentData .= "<tr><td>".$i."</td><td>{$student[2]}</td><td>{$student[1]}</td><td>{$studentMarksDataLine[0]}</td><td>{$studentMarksDataLine[1]}</td><td>{$studentMarksDataLine[2]}</td><td>{$studentMarksDataLine[3]}</td></tr>";
            break;
        }
    }
}
fclose($marksFile);
fclose($studentsFile);
?>
<!DOCTYPE html>
<html lang="lt">
    <head>
        <title>Pažymių lentelė</title>
    </head>
    <body>
        <table border = 1>
            <tr>
                <th>Eil. nr.</th>
                <th>Vardas</th>
                <th>Pavardė</th>
                <th>Mokinio numeris</th>
                <th>Dalykas</th>
                <th>Pažymys</th>
                <th>Pastabos, komentarai</th>
            </tr>
            <?= $studentData?>
        </table>
    </body>
</html>