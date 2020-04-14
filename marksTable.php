<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$marksFilename = 'marks.csv';
if (!file_exists($marksFilename) or !is_readable($marksFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo su mokinių pažymiais!";
    include 'errorTemplate.php';
    exit();
}
$studentData = " ";
$i = 0;
if (($marksFile = fopen($marksFilename, "r")) !== FALSE) {
    while (($studentDataLine = fgetcsv($marksFile, ",")) !== FALSE) {
        $i++;
        $studentData .= "<tr><td>".$i."</td><td>{$studentDataLine[0]}</td><td>{$studentDataLine[1]}</td><td>{$studentDataLine[2]}</td><td>{$studentDataLine[3]}</td><td>{$studentDataLine[4]}</td><td>{$studentDataLine[5]}</td></tr>";
    }
    fclose($marksFile);
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