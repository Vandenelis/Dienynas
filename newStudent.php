<?php
$studentsFilename = 'students.csv';
include 'studentsFile.php';
checkIfStudentsFileExistsAndIsWritable();
$message = "";
$saved = "";
if (!empty($_POST['vardas']) and !empty($_POST['pavarde']) and !empty($_POST['numeris'])) {
    var_dump(saveNewStudent());
    if (saveNewStudent() === '') {
        $saved = "Išsaugota";
    } else {
        $message = saveNewStudent();
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