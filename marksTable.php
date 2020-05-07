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

$studentData = "";
$i = 0;
$allStudentsNumber = 0;
$marksFile = fopen($marksFilename, "r");
$studentsFile = fopen($studentsFilename, "r");
while(($studentDataLine = fgetcsv($studentsFile, ",")) !== FALSE){
    $allStudentsNumber = $allStudentsNumber+1;//$allStudentsNumber = 4
}
rewind($studentsFile);
while(($studentMarksDataLine = fgetcsv($marksFile, ",")) !== FALSE){
    for($a=0; $a < $allStudentsNumber; $a++) {//kartosis 12 kartų (3 pazymiai*4 stud)
        $studentDataLine = fgetcsv($studentsFile, ",");
        if ($studentDataLine[0] === $studentMarksDataLine[0]) {
            $i++;
            $studentData .= "<tr><td>".$i."</td><td>{$studentDataLine[2]}</td><td>{$studentDataLine[1]}</td><td>{$studentMarksDataLine[0]}</td><td>{$studentMarksDataLine[1]}</td><td>{$studentMarksDataLine[2]}</td><td>{$studentMarksDataLine[3]}</td></tr>";
        } 
    }
    rewind($studentsFile);
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