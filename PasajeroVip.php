<?php
include_once('Pasajero.php');

class PasajeroVip extends Pasajero
{
  //Atributos
  private $numViajeroFrecuente;
  private $cantMillasPasajeros;

  //Metodo Constructor de la clase
  public function __construct($nombre, $apellido, $numDocumento, $telefono, $numAsiento, $numTicketViaje, $numViajeroFrecuente, $cantMillasPasajeros)
  {
    //Invocamos al constructor de Pasajero
    parent::__construct($nombre, $apellido, $numDocumento, $telefono, $numAsiento, $numTicketViaje);
    //Agregamos los nuevos atributos
    $this->numViajeroFrecuente = $numViajeroFrecuente;
    $this->cantMillasPasajeros = $cantMillasPasajeros;
  }

  //Retornos (Get)
  public function getNumViajeroFrecuente()
  {
    return $this->numViajeroFrecuente;
  }

  public function getCantMillasPasajeros()
  {
    return $this->cantMillasPasajeros;
  }

  //Metodos de Manipulacion (Set)
  public function setNumViajeroFrecuente($numViajeroFrecuente)
  {
    $this->numViajeroFrecuente = $numViajeroFrecuente;
  }
  public function setCantMillasPasajeros($cantMillasPasajeros)
  {
    $this->cantMillasPasajeros = $cantMillasPasajeros;
  }

  // Metodo ToString que imprime por pantalla
  public function __toString()
  {
    $cadena = parent::__toString();
    $cadena .= '\nNumero de viajero frecuente: ' . $this->getNumViajeroFrecuente() . '\n' .
      'Cantidad de millas: ' . $this->getCantMillasPasajeros() . '\n';
    return $cadena;
  }

  //Redefino el metodo darPorcentajeIncremento de la clase base (pasajero)
  public function darPorcentajeIncremento(){
    $porcentaje = 0;
    $cantidadMillas = $this->getCantMillasPasajeros();
    if ($cantidadMillas > 300) {
      $porcentaje = 30;
    }else {
      $porcentaje = 35;
    }
    return $porcentaje;
  }
}
