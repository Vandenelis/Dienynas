<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$marksFilename = 'marks.csv';
if (!file_exists($marksFilename) or !is_readable($marksFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo su mokinių pažymiais skaitymui!";
    include 'errorTemplate.php';
    exit();
}
$propertiesFilename = 'properties.php';
if (!file_exists($propertiesFilename) or !is_readable($propertiesFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo su mokinių kontaktine informacija skaitymui!";
    include 'errorTemplate.php';
    exit();
}

include('class.php');
$studentData = "";
$studentMarksData = "";
$i = 0;
$marksFile = fopen($marksFilename, "r");
$propertiesFile = fopen($propertiesFilename, 'r');
while (((($serializedStudent = fgets($propertiesFile)) !==false)) and (($studentDataLine = fgetcsv($marksFile, ",")) !== FALSE)) {
    $serializedStudent = trim($serializedStudent, "\n");
    $student = unserialize($serializedStudent);
    $studentData = get_object_vars($student);
    $i++;
    $studentMarksData .= "<tr><td>".$i."</td><td>{$studentDataLine[0]}</td><td>{$studentDataLine[1]}</td><td>{$studentDataLine[2]}</td><td>{$studentDataLine[3]}</td><td>{$studentDataLine[4]}</td><td>{$studentDataLine[5]}</td><td>{$studentData['tevoVardas']} {$studentData['tevoPavarde']}</td><td>{$studentData['tevoTelefonas']} {$studentData['tevoElPastas']}</td><td>{$studentData['motinosVardas']} {$studentData['motinosPavardecla']}</td><td>{$studentData['motinosTelefonas']} {$studentData['motinosElPastas']}</td></tr>";
}  
fclose($marksFile);
fclose($propertiesFile);
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
                <th>Mokinio tėvo vardas, pavardė</th>
                <th>Mokinio tėvo kontaktai</th>
                <th>Mokinio motinos vardas, pavardė</th>
                <th>Mokinio motinos kontaktai</th>
            </tr>
            <?= $studentMarksData?>
        </table>
    </body>
</html>