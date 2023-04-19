<?php

class Pasajero
{
  //Atributos
  private $nombre;
  private $apellido;
  private $numDocumento;
  private $telefono;

  //Metodos Constructor de la clase
  public function __construct($nombre, $apellido, $numDocumento, $telefono)
  {
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->numDocumento = $numDocumento;
    $this->telefono = $telefono;
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

  // Metodo tostring que imprime por pantalla
  public function __toString()
  {
    return "Nombre: " . $this->getNombre() . "\n" .
      "Apellido: " . $this->getApellido() . "\n" .
      "Número de documento: " . $this->getNumDocumento() . "\n" .
      "Teléfono: " . $this->getTelefono() . "\n";
  }
}
