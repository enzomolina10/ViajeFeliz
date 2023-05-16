<?php

class ResponsableV
{
  //Atributos
  private $numResponsable;
  private $numLicencia;
  private $nombre;
  private $apellido;

  //Metodos Constructor de la clase
  public function __construct($numResponsable, $numLicencia, $nombre, $apellido)
  {
    $this->numResponsable = $numResponsable;
    $this->numLicencia = $numLicencia;
    $this->nombre = $nombre;
    $this->apellido = $apellido;
  }

  //Retornos (get)
  public function getNumResponsable()
  {
    return $this->numResponsable;
  }
  public function getNumLicencia()
  {
    return $this->numLicencia;
  }
  public function getNombre()
  {
    return $this->nombre;
  }
  public function getApellido()
  {
    return $this->apellido;
  }

  //Metodos de Manipulacion (set)
  public function setNumResponsable($numResponsable)
  {
    $this->numResponsable = $numResponsable;
  }
  public function setNumLicencia($numLicencia)
  {
    $this->numLicencia = $numLicencia;
  }
  public function setNombre($nombre)
  {
    $this->nombre = $nombre;
  }
  public function setApellido($apellido)
  {
    $this->apellido = $apellido;
  }

  // Metodo ToString que imprime por pantalla
  public function __toString()
  {
    return "\nNúmero de empleado: " . $this->getNumResponsable() . ". \nNúmero de Licencia: " . $this->getNumLicencia() . ". \nNombre: " . $this->getNombre() . ". \nApellido: " . $this->getApellido() . ". \n";
  }
}
