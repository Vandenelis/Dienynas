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
function saveNewStudent($numeris, $pavarde, $vardas) {
    $studentsFilename = 'students.csv';
    if (!empty($vardas) and !empty($pavarde) and !empty($numeris)){
        checkIfStudentsFileExistsAndIsWritable();
        $studentsFile = fopen($studentsFilename, "r");
        while (($studentData = fgetcsv($studentsFile, ",")) !== FALSE) {
            if ($studentData[0] === $numeris) {
                fclose($studentsFile);
                return "Toks mokinio numeris jau panaudotas, įveskite kitą skaičių.";
            }
        }
        fclose($studentsFile);
        
        $duomenys = [$numeris, $pavarde, $vardas];
        $studentsFile = fopen($studentsFilename, 'a');//jei failo nėra, tai jis bus sukurtas
        fputcsv($studentsFile, $duomenys);
        fclose($studentsFile);
    }
    return null;
}
?>
