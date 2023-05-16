<?php
include_once('Pasajero.php');

class PasajerosEspeciales extends Pasajero
{
  //Atributos
  private $sillaRuedas;
  private $asistencia;
  private $comidasEspeciales;
  //Metodo Constructor de la clase
  public function __construct($nombre, $apellido, $numDocumento, $telefono, $numAsiento, $numTicketViaje, $sillaRuedas, $asistencia, $comidasEspeciales)
  {
    //Invocamos al constructor de Pasajero
    parent::__construct($nombre, $apellido, $numDocumento, $telefono, $numAsiento, $numTicketViaje);
    //Agregamos los nuevos atributos
    $this->sillaRuedas = $sillaRuedas;
    $this->asistencia = $asistencia;
    $this->comidasEspeciales = $comidasEspeciales;
  }
  //Retornos (Get)
  public function getSillaRuedas()
  {
    return $this->sillaRuedas;
  }
  public function getAsistencia()
  {
    return $this->asistencia;
  }
  public function getComidasEspeciales()
  {
    return $this->comidasEspeciales;
  }

  //Metodos de Manipulacion (Set)
  public function setSillaRuedas($sillaRuedas)
  {
    $this->sillaRuedas = $sillaRuedas;
  }
  public function setAsistencia($asistencia)
  {
    $this->asistencia = $asistencia;
  }
  public function setComidasEspeciales($comidasEspeciales)
  {
    $this->comidasEspeciales = $comidasEspeciales;
  }

  // Metodo ToString que imprime por pantalla
  public function __toString()
  {
    $cadena = parent::__toString();
    $cadena .= 'servicios especiales como sillas de ruedas' . $this->getSillaRuedas() . "\n" . 'Pasajeros que pueden requerir servicios especiales: ' . $this->getAsistencia() . "\n" .
      'Comidas especiales para personas con alergias o restricciones alimentarias ' . $this->getComidasEspeciales() . "\n";
  }
  //Redefino el metodo darPorcentajeIncremento de la clase base (pasajero)
  public function darPorcentajeIncremento()
  {
    $porcentaje = 0;
    if ($this->getSillaRuedas() == "si" && $this->getAsistencia() == "si" && $this->getComidasEspeciales() == "si") {
      $porcentaje = 30;
    } elseif ($this->getSillaRuedas() == "si" || $this->getAsistencia() == "si" || $this->getComidasEspeciales() == "si") {
      $porcentaje = 15;
    }
    return $porcentaje;
  }
}
