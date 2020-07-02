<?php
function studentsFileWritable() {
    $studentsFilename = 'students.csv';
    if (file_exists($studentsFilename) and (!is_writable($studentsFilename) or !is_readable($studentsFilename))) {
        $errorMessage = "Nepavyksta atidaryti failo su mokinių sąrašu rašymui arba skaitymui!";
        include 'errorTemplate.php';
        exit();
    }
}
function studentsFileReadable() {
    $studentsFilename = 'students.csv';
    if (!file_exists($studentsFilename) or !is_readable($studentsFilename)) {
        $errorMessage = "Nepavyksta atidaryti failo su mokinių sąrašu skaitymui!";
        include 'errorTemplate.php';
        exit();
    }
}
function studentsArray() {
    $studentsFilename = 'students.csv';
    $studentsFile = fopen($studentsFilename, "r");
    $array = [];
    while(($studentDataLine = fgetcsv($studentsFile, ",")) !== FALSE){
        $array[] = $studentDataLine;
    }
    fclose($studentsFile);
    return $array;
}
?>
