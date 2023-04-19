<?php
//Incorporo el script Viaje.
include_once('Viaje.php');
include_once("Pasajero.php");
include_once("ResponsableV.php");

//Arreglo predefinido con info de personas.
$pasajerosPredefinidos[0] = new Pasajero('Iban', 'Coca', 92837054, 2991232345);
$pasajerosPredefinidos[1] = new Pasajero('Herminia', 'Rojo', 27218687, 2991233452);

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
$viaje = new Viaje($codigo, $destino, $cantMaximaPasajeros, $datosResponsable);

// Seteamos los valores pasados por parametro.
$viaje->setCodigo($codigo);
$viaje->setDestino($destino);
$viaje->setCantMaximaPasajeros($cantMaximaPasajeros);
$viaje->setPasajeros($pasajerosPredefinidos);
$viaje->setResponsable($datosResponsable);

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
  echo "6. Pasajeros(Modificar,agregar,eliminar).\n";
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
  echo "2. Agregar pasajeros. \n";
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
                  echo "Ingrese nombre, apellido, número de documento y número de telefono. En su respectivo orden. \n";
                  $arregloDatosModificados = [
                    new Pasajero(trim(fgets(STDIN)), trim(fgets(STDIN)), trim(fgets(STDIN)), trim(fgets(STDIN)))
                  ];
                  $viaje->modificarPasajero($rta, $arregloDatosModificados);
                  break;
                case 2:
                  if ($viaje->stockLugar()) {
                    echo "Ingrese nombre del pasajero:\n";
                    $nombre = trim(fgets(STDIN));
                    echo "Ingrese apellido del pasajero:\n";
                    $apellido = trim(fgets(STDIN));
                    echo "Ingrese el número de documento del pasajero:\n";
                    $nroDoc = trim(fgets(STDIN));
                    echo "Ingrese el número de teléfono del pasajero:\n";
                    $telefono = trim(fgets(STDIN));
                    $viaje->agregarPasajero($nombre, $apellido, $nroDoc, $telefono);
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
