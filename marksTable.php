<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$marksFilename = 'marks.txt';
@$marksFile = fopen(@$marksFilename, "r");
if (!file_exists($marksFilename) or !is_readable($marksFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo su mokinių pažymiais!";
    include 'errorTemplate.php';
    exit();
}
$studentData = ",";
for ($line = fgets($marksFile), $i = 1; !feof($marksFile); $line = fgets($marksFile), $i++) {
    $studentDataChunk = explode (",", $line);
    $studentDataChunk[0] = str_replace(",,", " ", $studentDataChunk[0]);
    $studentData .= "<tr><td>".$i."</td><td>".$studentDataChunk[0]."</td><td>".$studentDataChunk[1]."</td><td>".$studentDataChunk[2]."</td><td>".$studentDataChunk[3]."</td></tr>";
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
            </tr>
            <?= $studentData?>
        </table>
    </body>
</html>