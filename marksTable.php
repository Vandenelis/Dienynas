<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$marksFilename = 'marks.csv';
@$marksFile = fopen(@$marksFilename, "r");
if (!file_exists($marksFilename) or !is_readable($marksFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo su mokinių pažymiais!";
    include 'errorTemplate.php';
    exit();
}
$studentData = " ";
$i = 0;
if (($handle = fopen('marks.csv', 'r')) !== FALSE) {
    while (($studentDataLine = fgetcsv($handle, ",")) !== FALSE) {
        $i++;
        $studentDataChunk = explode (",", $studentDataLine[0]);
        $studentDataChunk = str_replace("_", ", ", $studentDataChunk);
        $studentData .= "<tr><td>".$i."</td><td>{$studentDataChunk[0]}</td><td>{$studentDataChunk[1]}</td><td>{$studentDataLine[1]}</td><td>{$studentDataLine[2]}</td><td>{$studentDataLine[3]}</td></tr>";
    }
    fclose($handle);
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
                <th>Dalykas</th>
                <th>Pažymys</th>
                <th>Pastabos, komentarai</th>
            </tr>
            <?= $studentData?>
        </table>
    </body>
</html>