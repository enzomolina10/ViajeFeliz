<?php
//Incorporo el script Viaje.
include_once('Viaje.php');
/* include_once("Pasajero.php"); */
include_once("ResponsableV.php");

//Arreglo predefinido con info de personas.
$pasajerosPredefinidos[0] = new Pasajero('Iban', 'Coca', 92837054, 2991232345, 01, 1);
$pasajerosPredefinidos[1] = new Pasajero('Herminia', 'Rojo', 27218687, 2991233452, 02, 2);

// Le pedimos al usuario que ingrese los datos necesarios.
echo "\n¡Bienvenido a Viaje Feliz! \n";
echo "Ingrese el código del viaje: \n";
$codigo = trim(fgets(STDIN));
echo "Ingrese el destino del viaje: \n";
$destino = trim(fgets(STDIN));
echo "Ingrese la cantidad máxima de pasajeros del viaje: \n";
$cantMaximaPasajeros = trim(fgets(STDIN));
$datosResponsable = obtenerDatos();

// Creamos una instancia de la clase Viaje.
$viaje = new Viaje($codigo, $destino, $cantMaximaPasajeros, $datosResponsable, 100, 0);

// Seteamos los valores pasados por parametro.
$viaje->setCodigo($codigo);
$viaje->setDestino($destino);
$viaje->setCantMaximaPasajeros($cantMaximaPasajeros);
$viaje->setPasajeros($pasajerosPredefinidos);
$viaje->setResponsable($datosResponsable);
/* $viaje->setCostoViaje($costoViaje);
$viaje->setCostoAbonados($costoAbonados); */

//Funcion para obtener los datos de los del responsable
function obtenerDatos()
{
  echo "Ingrese el Número de Empleado del responsable: \n";
  $numEmpleado = trim(fgets(STDIN));
  echo "Ingrese el Número de Licencia del responsable: \n";
  $numLicencia = trim(fgets(STDIN));
  echo "Ingrese el Nombre del responsable: \n";
  $nombre = trim(fgets(STDIN));
  echo "Ingrese el Apellido del responsable: \n";
  $apellido = trim(fgets(STDIN));
  $objetoCreado = new ResponsableV($numEmpleado, $numLicencia, $nombre, $apellido);
  return $objetoCreado;
}

//Imprime en pantalla un mensaje informando que ingresó la opcion correcta.
function reingresarOpcion()
{
  echo "---------------------------------------------------------------------\n";
  echo "       ingresá el numero de la opcion que quieras realizar \n";
  echo "---------------------------------------------------------------------\n";
}

//Imprime en pantalla el Menú para modificar la info del viaje.
function menuDatosNuevos()
{
  echo "----------------------\n";
  echo "Que dato desea cambiar?\n";
  echo "1. Codigo.\n";
  echo "2. Destino.\n";
  echo "3. Cantidad maxima de pasajeros.\n";
  echo "4. Todas las anteriores.\n";
  echo "5. Responsable del Viaje.\n";
  echo "6. Pasajeros(Modificar,Vender Pasaje,eliminar).\n";
  echo "7. Salir.\n";
  echo "----------------------\n";
}

//Imprime en pantalla el Menú principal.
function menu()
{
  echo "\n-------- Menú --------\n";
  echo "1. Modificar información del viaje.\n";
  echo "2. Ver información del viaje.\n";
  echo "3. Salir.\n";
  echo "----------------------\n";
}

//Imprime en pantalla el Menú para modificar PASAJEROS.
function menuModificarPasajeros()
{
  echo "----------------------\n";
  echo "1. Modificar pasajeros. \n";
  echo "2. Vender Pasaje. \n";
  echo "3. Eliminar pasajeros. \n";
  echo "4. Volver al menu. \n";
  echo "----------------------\n";
}

//Menú funcional.
do {
  menu();
  $opcion = trim(fgets(STDIN));
  switch ($opcion) {
    case 1:
      do {
        menuDatosNuevos();
        $opcionMenuDatosNuevos = trim(fgets(STDIN));
        switch ($opcionMenuDatosNuevos) {
          case 1:
            echo "Ingrese el nuevo codigo: \n";
            $rta = trim(fgets(STDIN));
            $viaje->setCodigo($rta);
            break;
          case 2:
            echo "Ingrese el nuevo destino: \n";
            $rta = trim(fgets(STDIN));
            $viaje->setDestino($rta);
            break;
          case 3:
            echo "Ingrese la nueva cantidad maxima de pasajeros: \n";
            $rta = trim(fgets(STDIN));
            if (!($rta < count($viaje->getPasajeros()))) {
              $viaje->setCantMaximaPasajeros($rta);
            } else {
              echo "-------------------------------------------------------------------------------------------\n";
              echo "La cantidad máxima de pasajeros no puede ser menor que la cantidad actual de pasajeros.\n";
              echo "-------------------------------------------------------------------------------------------\n";
            }
            break;
          case 4:
            echo "Ingrese el nuevo codigo: \n";
            $rtaCodigo = trim(fgets(STDIN));
            $viaje->setCodigo($rtaCodigo);
            echo "\nIngrese el nuevo destino: \n";
            $rtaDestino = trim(fgets(STDIN));
            $viaje->setDestino($rtaDestino);
            echo "Ingrese la nueva cantidad maxima de pasajeros: \n";
            $rta = trim(fgets(STDIN));
            if (!($rta < count($viaje->getPasajeros()))) {
              $viaje->setCantMaximaPasajeros($rta);
            } else {
              echo "-------------------------------------------------------------------------------------------\n";
              echo "La cantidad máxima de pasajeros no puede ser menor que la cantidad actual de pasajeros.\n";
              echo "-------------------------------------------------------------------------------------------\n";
            }
            break;
          case 5:
            $responsableModificado = obtenerDatos();
            $viaje->setResponsable($responsableModificado);
            break;
          case 6:
            do {
              menuModificarPasajeros();
              $rtaMenuModificarPasajeros = trim(fgets(STDIN));
              switch ($rtaMenuModificarPasajeros) {
                case 1:
                  echo "Ingrese el numero de documento que desea cambiar\n";
                  $rta = trim(fgets(STDIN));
                  echo "Ingrese nombre, apellido, número de documento, número de telefono, número de asiento y número de ticket. En su respectivo orden. \n";
                  $arregloDatosModificados = [
                    new Pasajero(trim(fgets(STDIN)), trim(fgets(STDIN)), trim(fgets(STDIN)), trim(fgets(STDIN)), trim(fgets(STDIN)), trim(fgets(STDIN)))
                  ];
                  $viaje->modificarPasajero($rta, $arregloDatosModificados);
                  break;
                case 2:
                  if ($viaje->hayPasajesDisponible()) {
                    do {
                      echo "Que tipo de pasajero desea agregar? \n 1)Pasajeros estándar.\n 2)Pasajero VIP.\n 3)Pasajero con necesidades especiales.\n";
                      $rtaTipoPasajero = trim(fgets(STDIN));
                    } while (!($rtaTipoPasajero <= 3 && $rtaTipoPasajero >= 1));
                    /* $viaje->agregarPasajero($nombre, $apellido, $nroDoc, $telefono, $asiento, $ticket); */
                    switch ($rtaTipoPasajero) {
                      case 1:
                        echo "Ingrese nombre del pasajero:\n";
                        $nombre = trim(fgets(STDIN));
                        echo "Ingrese apellido del pasajero:\n";
                        $apellido = trim(fgets(STDIN));
                        echo "Ingrese el número de documento del pasajero:\n";
                        $nroDoc = trim(fgets(STDIN));
                        echo "Ingrese el número de teléfono del pasajero:\n";
                        $telefono = trim(fgets(STDIN));
                        echo "Ingrese el número de asiento del pasajero:\n";
                        $asiento = trim(fgets(STDIN));
                        echo "Ingrese el número de ticket del pasajero:\n";
                        $ticket = trim(fgets(STDIN));
                        $objTipoEstandar = new Pasajero($nombre, $apellido, $nroDoc, $telefono, $asiento, $ticket);
                        $abonarTotal = $viaje->venderPasaje($objTipoEstandar);
                        if ($abonarTotal) {
                          echo "Pasaje vendido con éxito. $abonarTotal";
                        }
                        break;
                      case 2:
                        echo "Ingrese nombre del pasajero:\n";
                        $nombre = trim(fgets(STDIN));
                        echo "Ingrese apellido del pasajero:\n";
                        $apellido = trim(fgets(STDIN));
                        echo "Ingrese el número de documento del pasajero:\n";
                        $nroDoc = trim(fgets(STDIN));
                        echo "Ingrese el número de teléfono del pasajero:\n";
                        $telefono = trim(fgets(STDIN));
                        echo "Ingrese el número de asiento del pasajero:\n";
                        $asiento = trim(fgets(STDIN));
                        echo "Ingrese el número de ticket del pasajero:\n";
                        $ticket = trim(fgets(STDIN));
                        echo "Ingrese el Numero de viajero frecuente: \n";
                        $numViajeroVip = trim(fgets(STDIN));
                        echo "Ingrese la Cantidad de millas: \n";
                        $cantMillasVip = trim(fgets(STDIN));
                        $pasajeroVip = new PasajeroVip($nombre, $apellido, $nroDoc, $telefono, $asiento, $ticket, $numViajeroVip, $cantMillasVip);
                        $abonarTotal = $viaje->venderPasaje($pasajeroVip);
                        if ($abonarTotal) {
                          echo "Pasaje vendido con éxito. $abonarTotal";
                        }
                        break;
                      case 3:
                        echo "Ingrese nombre del pasajero:\n";
                        $nombre = trim(fgets(STDIN));
                        echo "Ingrese apellido del pasajero:\n";
                        $apellido = trim(fgets(STDIN));
                        echo "Ingrese el número de documento del pasajero:\n";
                        $nroDoc = trim(fgets(STDIN));
                        echo "Ingrese el número de teléfono del pasajero:\n";
                        $telefono = trim(fgets(STDIN));
                        echo "Ingrese el número de asiento del pasajero:\n";
                        $asiento = trim(fgets(STDIN));
                        echo "Ingrese el número de ticket del pasajero:\n";
                        $ticket = trim(fgets(STDIN));
                        do {
                          echo "Necesita servicios especiales como sillas de ruedas?(si/no) \n";
                          $sillasRueda = trim(fgets(STDIN));
                          $sillasRuedaMinus = strtolower($sillasRueda);
                          echo "Requiere servicios especiales?(si/no) \n";
                          $servicios = trim(fgets(STDIN));
                          $serviciosMinus = strtolower($servicios);
                          echo "Tiene alergias o restricciones alimentarias?(si/no) \n";
                          $comidasEspe = trim(fgets(STDIN));
                          $comidasEspeMinus = strtolower($comidasEspe);
                        } while (!(($sillasRuedaMinus == "si" || $sillasRuedaMinus == "no") && ($serviciosMinus == "si" || $serviciosMinus == "no") && ($comidasEspeMinus == "si" || $comidasEspeMinus == "no")));
                        $pasajeroEspe = new PasajerosEspeciales($nombre, $apellido, $nroDoc, $telefono, $asiento, $ticket, $sillasRuedaMinus, $serviciosMinus, $comidasEspeMinus);
                        $abonarTotal = $viaje->venderPasaje($pasajeroEspe);
                        if ($abonarTotal) {
                          echo "Pasaje vendido con éxito. $abonarTotal";
                        }
                        break;
                      default:
                        reingresarOpcion();
                        break;
                    }
                  } else {
                    echo "\n---------------\n";
                    echo "No hay mas lugar.";
                    echo "\n---------------\n";
                    break 2;
                  }
                  break;
                case 3:
                  echo "Ingrese el numero de documento de la persona que desea sacar\n";
                  $rta = trim(fgets(STDIN));
                  $viaje->sacarPasajero($rta);
                  break;
                case 4:
                  break 2;
                default:
                  reingresarOpcion();
                  break;
              }
            } while (!($rtaMenuModificarPasajeros >= 1 && $rtaMenuModificarPasajeros <= 4));
            break;
          case 7:
            echo "\nGracias, vuelva prontos. \n";
            break;
          default:
            reingresarOpcion();
        }
      } while (!($opcionMenuDatosNuevos >= 1 && $opcionMenuDatosNuevos <= 7));
      break;
    case 2:
      echo "\n----------\n";
      echo $viaje;
      echo "------------\n";
      break;
    case 3:
      echo "Gracias, vuelva prontos.";
      break;
    default:
      reingresarOpcion();
  }
} while (!($opcion == 3));
