<?php
include('class.php');

$student = new studentInfo();
$student -> vardas = $_POST['vardas'];
$student -> pavarde = $_POST['pavarde'];
$student -> numeris = $_POST['numeris'];
$student -> gimimoData = $_POST['gimimoData'];
$student -> asmKodas = $_POST['asmKodas'];
$student -> adresas = $_POST['adresas'];
$student -> tevoVardas = $_POST['tevoVardas'];
$student -> tevoPavarde = $_POST['tevoPavarde'];
$student -> tevoTelefonas = $_POST['tevoTelefonas'];
$student -> tevoElPastas = $_POST['tevoElPastas'];
$student -> motinosVardas = $_POST['motinosVardas'];
$student -> motinosPavarde = $_POST['motinosPavarde'];
$student -> motinosTelefonas = $_POST['motinosTelefonas'];
$student -> motinosElPastas = $_POST['motinosElPastas'];

$studentsFilename = 'students.csv';
if (file_exists($studentsFilename) and (!is_writable($studentsFilename) or !is_readable($studentsFilename))) {
    $errorMessage = "Nepavyksta atidaryti failo su mokinių sąrašu rašymui arba skaitymui!";
    include 'errorTemplate.php';
    exit();
}
        
$saved = "";
$studentNumberMessage = "";  
if (!empty($_POST['vardas']) and !empty($_POST['pavarde']) and !empty($_POST['numeris']) and !empty($_POST['gimimoData']) and !empty($_POST['asmKodas']) and !empty($_POST['adresas']) and !empty($_POST['tevoVardas']) and !empty($_POST['tevoPavarde']) and !empty($_POST['tevoTelefonas']) and !empty($_POST['tevoElPastas']) and !empty($_POST['motinosVardas']) and !empty($_POST['motinosPavarde']) and !empty($_POST['motinosTelefonas']) and !empty($_POST['motinosElPastas'])) {
    $studentArray = get_object_vars($student);
    if (file_exists($studentsFilename)) {
        $studentsFile = new SplFileObject($studentsFilename);
        while(!$studentsFile -> eof()) {
            $studentData = $studentsFile -> fgetcsv();
            if ($studentData[2] === $studentArray['numeris']) {
                $studentNumberMessage = "Toks mokinio numeris jau panaudotas, įveskite kitą skaičių.";
            }
        }
    }
    if (empty($studentNumberMessage)) {
        $studentsFileA = new SplFileObject($studentsFilename, 'a'); //jei failo nėra, tai jis nebus sukurtas?
        $studentsFileA -> fputcsv($studentArray);
        $saved = "Išsaugota"; 
    }
}
$serializedStudent = serialize($student);
$serializedStudent = $serializedStudent."\n";
$propertiesFilename = 'properties.php';
file_put_contents($propertiesFilename, $serializedStudent, FILE_APPEND);
?>
<!DOCTYPE html>
<html lang="lt">
    <head>
        <title>Vardai ir Pavardės</title>
    </head>
    <body>
        <p><?= $studentNumberMessage?></p>
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
Mokinio gimimo data:<br>
            <input type="text" name="gimimoData" value="2000-01-01">
            <br>            
Mokinio asmens kodas:<br>
            <input type="text" name="asmKodas" value="00000000000">
            <br>
Mokinio adresas:<br>
            <textarea name="adresas" rows="2" cols="50">Gatvių g. 00, Grybų miestas</textarea>
            <br>
Mokinio tėvo (globėjo) vardas:<br>
            <input type="text" name="tevoVardas" value="Vardas">
            <br>
Mokinio tėvo (globėjo) pavardė:<br>
            <input type="text" name="tevoPavarde" value="Pavardenys">
            <br>
Mokinio tėvo (globėjo) telefono numeris:<br>
            <input type="text" name="tevoTelefonas" value="860000000">
            <br>
Mokinio tėvo (globėjo) el.paštas:<br>
            <input type="text" name="tevoElPastas" value="vardas.pavardenis@gmail.com">
            <br>
Mokinio motinos (globėjos) vardas:<br>
            <input type="text" name="motinosVardas" value="Vardė">
            <br>
Mokinio motinos (globėjos) pavardė:<br>
            <input type="text" name="motinosPavarde" value="Pavardenienė">
            <br>           
Mokinio motinos (globėjos) telefono numeris:<br>
            <input type="text" name="motinosTelefonas" value="860000001">
            <br>
Mokinio motinos (globėjos) el.paštas:<br>
            <input type="text" name="motinosElPastas" value="varde.pavardeniene@gmail.com">
            <br>
            <input type="submit" value="Išsaugoti">
        </form>
    </body>
</html>