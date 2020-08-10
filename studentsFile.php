<?php
function checkIfStudentsFileExistsAndIsWritable() {
    $studentsFilename = 'students.csv';
    if (file_exists($studentsFilename) and (!is_writable($studentsFilename) or !is_readable($studentsFilename))) {
        $errorMessage = "Nepavyksta atidaryti failo su mokinių sąrašu rašymui arba skaitymui!";
        include 'errorTemplate.php';
        exit();
    }
}
function getAllStudentsAsArray() {
    $studentsFilename = 'students.csv';
    if (!file_exists($studentsFilename) or !is_readable($studentsFilename)) {
        $errorMessage = "Nepavyksta atidaryti failo su mokinių sąrašu skaitymui!";
        include 'errorTemplate.php';
        exit();
    }
    $studentsFilename = 'students.csv';
    $studentsFile = fopen($studentsFilename, "r");
    $studentsFileArray = [];
    while(($studentDataLine = fgetcsv($studentsFile, ",")) !== FALSE){
        $studentsFileArray[] = $studentDataLine;
    }
    fclose($studentsFile);
    return $studentsFileArray;
}
function saveNewStudent() {
    $saved = "";
    $message = "";
    $studentsFilename = 'students.csv';
    if (!isset($_POST['vardas']) and !isset($_POST['pavarde']) and !isset($_POST['numeris'])){
        $vardas = null;
        $pavarde = null;
        $numeris = null;
    } else {
        $vardas = $_POST['vardas'];
        $pavarde = $_POST['pavarde'];
        $numeris = $_POST['numeris'];
        if (file_exists($studentsFilename)) {
            $studentsFile = fopen($studentsFilename, "r");
            while (($studentData = fgetcsv($studentsFile, ",")) !== FALSE) {
                if ($studentData[0] === $numeris) {
                    $message = "Toks mokinio numeris jau panaudotas, įveskite kitą skaičių.";
                }
            }
            fclose($studentsFile);
            //return;// $message; // kai nėra return message, yra return null atskiruose if, išsaugo, kai yra tik return ir return null neišsaugo
        }
        if (empty($message)) {
            $duomenys = [$numeris, $pavarde, $vardas];
            $studentsFile = fopen($studentsFilename, 'a');//jei failo nėra, tai jis bus sukurtas
            fputcsv($studentsFile, $duomenys);
            fclose($studentsFile);
            $saved = "Išsaugota";
            return;// null; //kai nėra return null, o yra return message, return ir return atskiruose if, neišsaugo
        }
    }
    return;// $message;//kai tik čia return, išsaugo. kai trys return, neišsaugo, kai čia return ir return null (arba tas be null) išsaugo, kai return, return null ir return, neišsaugo, 
}
?>
