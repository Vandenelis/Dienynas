<?php
function students($writing) {
    $studentsFilename = 'students.csv';
    if ($writing == "rašymui arba") {
        if (file_exists($studentsFilename) and (!is_writable($studentsFilename) or !is_readable($studentsFilename))) {
            $errorMessage = "Nepavyksta atidaryti failo su mokinių sąrašu $writing skaitymui!";
            include 'errorTemplate.php';
            exit();
        }
    } else {
        if (!file_exists($studentsFilename) or !is_readable($studentsFilename)) {
            $errorMessage = "Nepavyksta atidaryti failo su mokinių sąrašu $writing skaitymui!";
            include 'errorTemplate.php';
            exit();
        }
    }
}
?>
