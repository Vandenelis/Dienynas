<?php
function checkIfStudentsFileExistsAndIsWritable() {
    $studentsFilename = 'students.csv';
    if (file_exists($studentsFilename) and (!is_writable($studentsFilename) or !is_readable($studentsFilename))) {
        $errorMessage = "Nepavyksta atidaryti failo su mokinių sąrašu rašymui arba skaitymui!";
        include 'errorTemplate.php';
        exit();
    }
}
function checkIfStudentsFileExistAndIsReadable() {
    $studentsFilename = 'students.csv';
    if (!file_exists($studentsFilename) or !is_readable($studentsFilename)) {
        $errorMessage = "Nepavyksta atidaryti failo su mokinių sąrašu skaitymui!";
        include 'errorTemplate.php';
        exit();
    }
}
function getAllStudentsAsArray() {
    $studentsFilename = 'students.csv';
    $studentsFile = fopen($studentsFilename, "r");
    while(($studentDataLine = fgetcsv($studentsFile, ",")) !== FALSE){
        $studentsFileArray[] = $studentDataLine;
    }
    fclose($studentsFile);
    return $studentsFileArray;
}
?>
