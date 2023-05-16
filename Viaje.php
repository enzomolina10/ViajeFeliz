<?php
// La empresa de Transporte de Pasajeros “Viaje Feliz” quiere registrar la información referente a sus viajes. De cada viaje se precisa almacenar el código del mismo, destino, cantidad máxima de pasajeros y los pasajeros del viaje.
//Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los atributos de dicha clase (incluso los datos de los pasajeros). Utilice un array que almacene la información correspondiente a los pasajeros. Cada pasajero es un array asociativo con las claves “nombre”, “apellido” y “numero de documento”.
//Implementar un script testViaje.php que cree una instancia de la clase Viaje y presente un menú que permita cargar la información del viaje, modificar y ver sus datos.
include_once('PasajeroVip.php');
include_once('PasajerosEspeciales.php');
class Viaje
{
  //Atributos
  private $codigo;
  private $destino;
  private $cantMaximaPasajeros;
  private $pasajeros = array();
  private $responsable;
  private $costoViaje;
  private $costoAbonados;


  //Metodos Constructor de la clase
  public function __construct($codigo, $destino, $cantMaximaPasajeros, $responsable, $costoViaje, $costoAbonados)
  {
    $this->codigo = $codigo;
    $this->destino = $destino;
    $this->cantMaximaPasajeros = $cantMaximaPasajeros;
    $this->responsable = $responsable;
    $this->costoViaje = $costoViaje;
    $this->costoAbonados = $costoAbonados;
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

  public function getResponsable()
  {
    return $this->responsable;
  }

  public function getCostoViaje()
  {
    return $this->costoViaje;
  }

  public function getCostoAbonados()
  {
    return $this->costoAbonados;
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
  public function setResponsable($responsable)
  {
    $this->responsable = $responsable;
  }
  public function setCostoViaje($costoViaje)
  {
    $this->costoViaje = $costoViaje;
  }
  public function setCostoAbonados($costoAbonados)
  {
    $this->costoAbonados = $costoAbonados;
  }


  //Funciones para la manipulacion de los pasajeros

  //Agregar pasajeros al arreglo
  public function agregarPasajero($nombre, $apellido, $nroDoc, $telefono, $numAsiento, $numTicket)
  {
    $pasajeroNuevo = new Pasajero($nombre, $apellido, $nroDoc, $telefono, $numAsiento, $numTicket);
    $this->pasajeros[] = $pasajeroNuevo;
    $this->setPasajeros($this->pasajeros);
  }

  //Modificar pasajeros
  public function modificarPasajero($nroDoc, $nuevoPasajero)
  {
    $encontrado = false;
    foreach ($this->pasajeros as $indice => $pasajero) {
      if ($pasajero->getNumDocumento() == $nroDoc) {
        $encontrado = true;
        $this->pasajeros[$indice] = $nuevoPasajero[0];
        break;
      }
    }
    if (!$encontrado) {
      echo "El número de documento que ingresó es incorrecto o no existe.\n";
    }
  }

  //Sacar a un pasajero 
  public function sacarPasajero($nroDoc)
  {
    $pasajeros = $this->getPasajeros();
    $pasajerosNuevos = [];
    foreach ($pasajeros as $pasajero) {
      if ($pasajero->getNumDocumento() != $nroDoc) {
        $pasajerosNuevos[] = $pasajero;
      }
    }
    $this->pasajeros = $pasajerosNuevos;
    $this->setPasajeros($this->pasajeros);
  }

  //Verifica si hay mas lugar para otra persona
  public function hayPasajesDisponible()
  {
    $boolean = true;
    if (count($this->getPasajeros()) >= $this->getCantMaximaPasajeros()) {
      $boolean = false;
    }
    return $boolean;
  }


  public function venderPasaje($objPasajero)
  {
    if ($this->hayPasajesDisponible() == true) {
      $this->agregarPasajero($objPasajero->getNombre(), $objPasajero->getApellido(), $objPasajero->getNumDocumento(), $objPasajero->getTelefono(), $objPasajero->getNumAsiento(), $objPasajero->getNumTicketViaje());
      $porcentaje = $objPasajero->darPorcentajeIncremento();
      $costoTotal = $this->getCostoViaje() + ($this->getCostoViaje() * $porcentaje / 100);
      $actualizacionCostoAbonado = $costoTotal + $this->getCostoAbonados();
      $this->setCostoAbonados($actualizacionCostoAbonado);
      $str = "El costo total a abonar es de: $" . $costoTotal;
      return $str;
    }
    echo 'No hay pasaje disponible';
  }

  //Imprime por pantalla el arreglo de los pasajeros recorriendolos por un foreach
  public function stringPasajeros()
  {
    if (!is_array($this->getPasajeros())) {
      return "";
    }
    $strPasajeros = "";
    foreach ($this->getPasajeros() as $key => $pasajero) {
      $nombre = $pasajero->getNombre();
      $apellido = $pasajero->getApellido();
      $nroDoc = $pasajero->getNumDocumento();
      $telefono = $pasajero->getTelefono();
      $numAsiento = $pasajero->getNumAsiento();
      $numTicket = $pasajero->getNumTicketViaje();
      $strPasajeros .= "\nNombre: " . $nombre . "\nApellido: " . $apellido . "\nNumero de documento: " . $nroDoc . "\nNumero de telefono: " . $telefono . "\nNúmero de asiento: "  . $numAsiento . "\nNúmero de ticket: " . $numTicket . "\n";
    }
    return $strPasajeros;
  }

  // Metodo ToString que imprime por pantalla
  public function __toString()
  {
    $pasajeros = $this->stringPasajeros();
    return "El codigo del viaje es: " . $this->getCodigo() . ". \nEl destino es: " . $this->getDestino() . ". \nLa cantidad maxima de pasajeros es de: " . $this->getCantMaximaPasajeros() . ". \nLa informacion del responsable es: " . $this->getResponsable() . "El costo total abonado es de: " . $this->getCostoAbonados() . ". \nInformacion de los pasajeros: \n" . $pasajeros;
  }
}
