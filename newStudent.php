<?php
$studentsFilename = 'students.csv';
include 'studentsFile.php';
checkIfStudentsFileExistsAndIsWritable();
$vardas = "";
$pavarde = "";
$numeris = "";
$message = "";
$saved = "";
if (!empty($_POST['vardas']) and !empty($_POST['pavarde']) and !empty($_POST['numeris'])) {
    $vardas = $_POST['vardas'];
    $pavarde = $_POST['pavarde'];
    $numeris = $_POST['numeris'];
    $vardas = preg_replace('/[^a-zA-Z\' ]/', '', $vardas);
    $pavarde = preg_replace('/[^a-zA-Z\' ]/', '', $pavarde);
    $numeris = preg_replace('/[^0-9\' ]/', '', $numeris);    //varde ir pavardėje nebus išsaugomi skaičiai ir ženklai,mokinio numeryje - raidės ir ženklai
    if (saveNewStudent($numeris, $pavarde, $vardas) ==! null) {
        $message = saveNewStudent($numeris, $pavarde, $vardas);
    } else {
        $saved = "Išsaugota";
    }
        
}
?>
<!DOCTYPE html>
<html lang="lt">
    <head>
        <title>Vardai ir Pavardės</title>
    </head>
    <body>
        <p><?= $message?></p>
        <p><?= $saved?></p>
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