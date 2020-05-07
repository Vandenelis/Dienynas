<?php
class studentInfo implements Serializable {
    public $vardas;
    public $pavarde;
    public $numeris;
    public $gimimoData;
    public $asmKodas;
    public $adresas;
    public $tevoVardas;
    public $tevoPavarde;
    public $tevoTelefonas;
    public $tevoElPastas;
    public $motinosVardas;
    public $motinosPavarde;
    public $motinosTelefonas;
    public $motinosElPastas; 
    
    public function __construct() {
        $this -> vardas = $vardas;
        $this -> pavarde = $pavarde;
        $this -> numeris = $numeris;
        $this -> gimimoData = $gimimoData;
        $this -> asmKodas = $asmKodas;
        $this -> adresas = $adresas;
        $this -> tevoVardas = $tevoVardas;
        $this -> tevoPavarde = $tevoPavarde;
        $this -> tevoTelefonas = $tevoTelefonas;
        $this -> tevoElPastas = $tevoElPastas;
        $this -> motinosVardas = $motinosVardas;
        $this -> motinosPavarde = $motinosPavarde;
        $this -> motinosTelefonas = $motinosTelefonas;
        $this -> motinosElPastas = $motinosElPastas;
    }
    public function serialize() {
        return serialize([
        $this -> vardas,
        $this -> pavarde,
        $this -> numeris,
        $this -> gimimoData,
        $this -> asmKodas,
        $this -> adresas,
        $this -> tevoVardas,
        $this -> tevoPavarde,
        $this -> tevoTelefonas,
        $this -> tevoElPastas,
        $this -> motinosVardas,
        $this -> motinosPavarde,
        $this -> motinosTelefonas,
        $this -> motinosElPastas,
        ]);
    }
    public function unserialize($data) {
        list(
            $this -> vardas,
            $this -> pavarde,
            $this -> numeris,
            $this -> gimimoData,
            $this -> asmKodas,
            $this -> adresas,
            $this -> tevoVardas,
            $this -> tevoPavarde,
            $this -> tevoTelefonas,
            $this -> tevoElPastas,
            $this -> motinosVardas,
            $this -> motinosPavarde,
            $this -> motinosTelefonas,
            $this -> motinosElPastas
        ) = unserialize($data);
    }
}
?>