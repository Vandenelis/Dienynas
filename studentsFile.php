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
    $message = "";
    $studentsFilename = 'students.csv';
    if (!empty($_POST['vardas']) and !empty($_POST['pavarde']) and !empty($_POST['numeris'])) {
        if (file_exists($studentsFilename)) {
            $studentsFile = fopen($studentsFilename, "r");
            while (($studentData = fgetcsv($studentsFile, ",")) !== FALSE) {
                if ($studentData[0] === $_POST['numeris']) {
                    $message = "Toks mokinio numeris jau panaudotas, įveskite kitą skaičių.";
                }
            }
            fclose($studentsFile);
        }
        if (empty($message)) {
            $duomenys = [$_POST['numeris'], $_POST['pavarde'], $_POST['vardas']];
            $studentsFile = fopen($studentsFilename, 'a');//jei failo nėra, tai jis bus sukurtas
            fputcsv($studentsFile, $duomenys);
            fclose($studentsFile);
            $message = "Išsaugota"; 
        }
    }
    return $message;
}
?>
