<?php
// La empresa de Transporte de Pasajeros “Viaje Feliz” quiere registrar la información referente a sus viajes. De cada viaje se precisa almacenar el código del mismo, destino, cantidad máxima de pasajeros y los pasajeros del viaje.

//Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los atributos de dicha clase (incluso los datos de los pasajeros). Utilice un array que almacene la información correspondiente a los pasajeros. Cada pasajero es un array asociativo con las claves “nombre”, “apellido” y “numero de documento”.

//Implementar un script testViaje.php que cree una instancia de la clase Viaje y presente un menú que permita cargar la información del viaje, modificar y ver sus datos.

class Viaje
{
  //Atributos
  private $codigo;
  private $destino;
  private $cantMaximaPasajeros;
  private $pasajeros = [];


  //Metodos Constructor de la clase
  public function __construct($codigo, $destino, $cantMaximaPasajeros)
  {
    $this->codigo = $codigo;
    $this->destino = $destino;
    $this->cantMaximaPasajeros = $cantMaximaPasajeros;
  }

  //Retornos (get)
  public function getCodigo()
  {
    return $this->codigo;
  }

  public function getDestino()
  {
    return $this->destino;
  }

  public function getCantMaximaPasajeros()
  {
    return $this->cantMaximaPasajeros;
  }

  public function getPasajeros()
  {
    return $this->pasajeros;
  }


  //Metodos de Manipulacion (set)

  public function setCodigo($codigo)
  {
    $this->codigo = $codigo;
  }

  public function setDestino($destino)
  {
    $this->destino = $destino;
  }

  public function setCantMaximaPasajeros($cantMaximaPasajeros)
  {
    $this->cantMaximaPasajeros = $cantMaximaPasajeros;
  }

  public function setPasajeros($pasajeros)
  {
    $this->pasajeros = $pasajeros;
  }


  //Funciones para la manipulacion de los pasajeros

  //Modificar pasajeros
  public function modificarPasajero($nroDoc, $nuevoPasajero)
  {
    $encontrado = false;
    foreach ($this->pasajeros as $indice => $pasajero) {
      if ($pasajero['documento'] == $nroDoc) {
        $encontrado = true;
        $this->pasajeros[$indice] = $nuevoPasajero;
        break;
      }
    }
    if (!$encontrado) {
      echo "El número de documento que ingresó es incorrecto o no existe.\n";
    }
  }

  //metodo para agregar pasajeros al arreglo
  public function agregarPasajero($arregloPasajero)
  {
    $this->pasajeros[] = $arregloPasajero;
    $this->setPasajeros($this->pasajeros);
  }

  //metodo para sacar a un pasajero del arreglo
  public function sacarPasajero($nroDoc)
  {
    $pasajeros = $this->getPasajeros();
    $pasajerosNuevos = [];
    foreach ($pasajeros as $pasajero) {
      if ($pasajero['documento'] != $nroDoc) {
        $pasajerosNuevos[] = $pasajero;
      }
    }
    $this->pasajeros = $pasajerosNuevos;
    $this->setPasajeros($this->pasajeros);
  }

  //metodo que verifica si hay mas lugar para otra persona
  public function stockLugar()
  {
    $boolean = true;
    if (count($this->getPasajeros()) >= $this->getCantMaximaPasajeros()) {
      $boolean = false;
    }
    return $boolean;
  }

  //Imprime por pantalla el arreglo de los pasajeros recorriendolos por un foreach
  public function stringPasajeros()
  {
    if (!is_array($this->pasajeros)) {
      return "";
    }
    $strPasajeros = "";
    foreach ($this->pasajeros as $pasajero) {
      $nombre = $pasajero['nombre'];
      $apellido = $pasajero['apellido'];
      $nroDoc = $pasajero['documento'];
      $strPasajeros .= "\nNombre: " . $nombre . "\nApellido: " . $apellido . "\nNumero de documento: " . $nroDoc . "\n";
    }
    return $strPasajeros;
  }

  // Metodo tostring que imprime por pantalla
  public function __toString()
  {
    $pasajeros = $this->stringPasajeros();
    return "El codigo del viaje es: " . $this->getCodigo() . ". \nEl destino es: " . $this->getDestino() . ". \nLa cantidad maxima de pasajeros es de: " . $this->getCantMaximaPasajeros()  . ". \nY los pasajeros son: \n" . $pasajeros;
  }
}
