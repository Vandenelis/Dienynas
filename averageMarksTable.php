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
$studentData = "";
$studentsArray = getAllStudentsAsArray();
$marksArray = [];
$marksFile = fopen($marksFilename, "r");
while(($studentMarksDataLine = fgetcsv($marksFile, ",")) !== FALSE){
    $marksArray[] = $studentMarksDataLine;
}
fclose($marksFile);
$i = 0;
foreach ($studentsArray as $student) {
    $studentMarksSum = 0;
    $studentMarksCount = 0;
    foreach ($marksArray as $mark) {
        if ($mark[0]===$student[0]) { 
            $studentMarksSum += $mark[2];
            $studentMarksCount++;
        }
    }    
    if ($studentMarksCount>0) {
        $studentAverageMark = $studentMarksSum / $studentMarksCount;
        $i++;
        $studentData .= "<tr><td>".$i."</td><td>{$student[2]} {$student[1]}</td><td>".$studentAverageMark."</td></tr>";
    } else {
        $i++;
        $studentData .= "<tr><td>".$i."</td><td>{$student[2]} {$student[1]}</td><td>0</td></tr>";
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
                <th>Vardas,Pavardė</th>
                <th>Bendras pažymių vidurkis</th>
            </tr>
            <?= $studentData?>
        </table>
    </body>
</html>