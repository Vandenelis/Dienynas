<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$marksFilename = 'marks.csv';
@$marksFile = fopen(@$marksFilename, "r");
if (!file_exists($marksFilename) or !is_writable($marksFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo su mokinių pažymiais!";
    include 'errorTemplate.php';
    exit();
}
@$studentsFile = fopen(@$studentsFilename, "r");
$studentsFilename = 'students.csv';
if (!file_exists($studentsFilename) or !is_readable($studentsFilename)) {
    $errorMessage = "Nepavyksta atidaryti failo su mokinių sąrašu!";
    include 'errorTemplate.php';
    exit();
}
$saved = " ";
if (isset($_POST['student']) and isset($_POST['subject']) and isset($_POST['mark'])and isset($_POST['notes'])) {
    $studentMark = array(array($_POST['student'], $_POST['subject'], $_POST['mark'], $_POST['notes']));
    $fp = fopen('marks.csv', 'a');
    foreach($studentMark as $fields) {
        fputcsv($fp, $fields);
    }
    $saved = "Išsaugota";
    fclose($fp);
}

$studentOptions = " ";
if (($handle = fopen('students.csv', 'r')) !== FALSE) {
    while (($name = fgetcsv($handle, ",")) !== FALSE) {
        $num = count($name);
        if ($num > 2) {
            $num = $num/3;
        } else {
        $num = $num/2;
        }
        for ($c=0; $c<$num; $c++){
             if (count($name) > 2) {
                $studentOptions .= "<option value = '$name[0]_$name[1],$name[2]'>{$name[0]}, {$name[1]} {$name[2]}</option>";
            } else {
                $studentOptions .= "<option value = '$name[0],$name[1]'>{$name[0]} {$name[1]}</option>";
            }
        }
    }
    fclose($handle);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang = "lt">
    <head>
        <title>Naujo pažymio įvedimas</title>
    </head>
    <body>
        <p><?= $saved?></p>
        <h2>Įrašykite pažymį</h2>
        <form action = '' method = 'post'>
            <div>Mokinys:</div>
            <div>
                <select name = 'student'>
                    <?= $studentOptions?>
                </select>
            </div>
            <div>Dalykas:</div>
            <div><input type = 'text' name = 'subject' value = "Matematika"></div>
            <div>Pažymys:</div>
            <div><input type = 'text' name = 'mark' value = "7"></div>
            <div>Pastabos, komentarai:</div>
            <div><textarea rows = "5" cols = "50" name = "notes"> </textarea></div>
            <div><input type = 'submit' name = 'submitted' value = "Išsaugoti"></div>
        </form>
    </body>
</html>