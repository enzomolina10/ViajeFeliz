<?php

class Pasajero
{
  //Atributos
  private $nombre;
  private $apellido;
  private $numDocumento;
  private $telefono;
  private $numAsiento;
  private $numTicketViaje;

  //Metodos Constructor de la clase
  public function __construct($nombre, $apellido, $numDocumento, $telefono, $numAsiento, $numTicketViaje)
  {
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->numDocumento = $numDocumento;
    $this->telefono = $telefono;
    $this->numAsiento = $numAsiento;
    $this->numTicketViaje = $numTicketViaje;
  }

  //Retornos (get)
  public function getNombre()
  {
    return $this->nombre;
  }
  public function getApellido()
  {
    return $this->apellido;
  }
  public function getNumDocumento()
  {
    return $this->numDocumento;
  }
  public function getTelefono()
  {
    return $this->telefono;
  }

  public function getNumAsiento()
  {
    return $this->numAsiento;
  }

  public function getNumTicketViaje()
  {
    return $this->numTicketViaje;
  }

  //Metodos de Manipulacion (set)
  public function setNombre($nombre)
  {
    $this->nombre = $nombre;
  }
  public function setApellido($apellido)
  {
    $this->apellido = $apellido;
  }
  public function setNumDocumento($numDocumento)
  {
    $this->numDocumento = $numDocumento;
  }
  public function setTelefono($telefono)
  {
    $this->telefono = $telefono;
  }

  public function setNumAsiento($numAsiento)
  {
    $this->numAsiento = $numAsiento;
  }

  public function setNumTicketViaje($numTicketViaje)
  {
    $this->numTicketViaje = $numTicketViaje;
  }

  // Metodo ToString que imprime por pantalla
  public function __toString()
  {
    return "Nombre: " . $this->getNombre() . "\n" .
      "Apellido: " . $this->getApellido() . "\n" .
      "Número de documento: " . $this->getNumDocumento() . "\n" .
      "Teléfono: " . $this->getTelefono() . "\n" .
      "Número de asiento: " . $this->getNumAsiento() . "\n" .
      "Número de ticket: " . $this->getNumTicketViaje() . "\n";
  }

  public function darPorcentajeIncremento()
  {
    $porcentaje = 10;
    return $porcentaje;
  }
}
