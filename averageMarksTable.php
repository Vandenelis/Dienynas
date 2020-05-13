<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$marksFilename = 'marks.csv';
$studentsFilename = 'students.csv';
if (!file_exists($marksFilename) or !is_readable($marksFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo su mokinių pažymiais skaitymui!";
    include 'errorTemplate.php';
    exit();
}
if (!file_exists($studentsFilename) or !is_readable($studentsFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo su mokinių sąrašu skaitymui!";
    include 'errorTemplate.php';
    exit();
}

$studentData = "";
$i = 0;
$marksArray = [];
$studentsArray = [];
$marksFile = fopen($marksFilename, "r");
$studentsFile = fopen($studentsFilename, "r");
while(($studentMarksDataLine = fgetcsv($marksFile, ",")) !== FALSE){
    $marksArray[] = $studentMarksDataLine;
}
while(($studentDataLine = fgetcsv($studentsFile, ",")) !== FALSE){
    $studentsArray[] = $studentDataLine;
}
foreach ($studentsArray as $student) {
    $studentMarksSum = 0;
    $equalsCount = 0;
    foreach ($marksArray as $mark) {
        if ($mark[0] === $student[0]) { 
            $studentMarksSum = $studentMarksSum + $mark[2];
            $equalsCount++;
        }
    }
    if ($equalsCount>0) {
        $studentAverageMark = $studentMarksSum/$equalsCount;
        $i++;
        $studentData .= "<tr><td>".$i."</td><td>{$student[2]} {$student[1]}</td><td>".$studentAverageMark."</td></tr>";
    } else {
        $i++;
        $studentData .= "<tr><td>".$i."</td><td>{$student[2]} {$student[1]}</td><td>".$studentMarksSum."</td></tr>";
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
                <th>Vardas,Pavardė</th>
                <th>Bendras pažymių vidurkis</th>
            </tr>
            <?= $studentData?>
        </table>
    </body>
</html>