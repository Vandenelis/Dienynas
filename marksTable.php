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
checkIfStudentsFileExistAndIsReadable();

$studentData = "";
$studentsArray = [];
$studentsArray = getAllStudentsAsArray();
$marksArray = [];
$marksFile = fopen($marksFilename, "r");
while(($studentMarksDataLine = fgetcsv($marksFile, ",")) !== FALSE){
    $marksArray[] = $studentMarksDataLine;
}
fclose($marksFile);
$i = 0;
foreach ($studentsArray as $student) {
    foreach ($marksArray as $mark) {
        if ($mark[0]===$student[0]) {
            $i++;
            $studentData .= "<tr><td>".$i."</td><td>{$student[2]}</td><td>{$student[1]}</td><td>{$mark[0]}</td><td>{$mark[1]}</td><td>{$mark[2]}</td><td>{$mark[3]}</td></tr>";
        }
    }
}

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