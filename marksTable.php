<!DOCTYPE html>
<html lang="lt">
<head>
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
<?php
$marksFilename = 'marks.txt';
$marksFile = fopen($marksFilename, "r");
if (!file_exists($marksFilename) or !is_writable($marksFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo su mokinių pažymiais!";
    include 'errorTemplate.php';
    exit();
}
for ($line = fgets($marksFile), $i = 1; !feof($marksFile); $line = fgets($marksFile), $i++) {
    $studentDataChunk = explode (" ", $line);
    echo "<tr><td>".$i."</td><td>".$studentDataChunk[0]."</td><td>".$studentDataChunk[1]."</td><td>".$studentDataChunk[2]."</td><td>".$studentDataChunk[3]."</td></tr>";
}
?>
    </table>
</body>
</html>