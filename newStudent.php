<?php
$studentsFilename = 'students.csv';
include 'studentsFile.php';
checkIfStudentsFileExistsAndIsWritable();
$message = saveNewStudent();

?>
<!DOCTYPE html>
<html lang="lt">
    <head>
        <title>Vardai ir Pavardės</title>
    </head>
    <body>
        <p><?= $message?></p>
        <h2>Įrašykite naujo mokinio duomenis</h2>
        <form method="post">
Vardas:<br>
            <input type="text" name="vardas" value="Vardenis">
            <br>
Pavardė:<br>
            <input type="text" name="pavarde" value="Pavardenis">
            <br>
Mokinio numeris:<br>
            <input type="text" name="numeris" value="12345">
            <br>
            <input type="submit" value="Išsaugoti">
        </form>
    </body>
</html>