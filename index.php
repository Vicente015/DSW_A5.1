<?php

interface VehiculoBase {
  public function arrancar();
  public function apagar();
}

class Vehiculo
{
  public string $marca;
  protected string $modelo;
  public string $color;
  private string $matricula;
  private bool $encendido = false;

  public function __construct(string $marca, string $modelo, string $color, string $matricula) {
    $this->marca = $marca;
    $this->modelo = $modelo;
    $this->color = $color;
    self::setMatricula($matricula);
  }

  // Método destructor
  function __destruct() {
    print "Destruyendo " . __CLASS__ . "\n";
  }

  private function setMatricula(string $matricula) {
    $this->matricula = $matricula;
  }

  public function getMatricula(): string {
    return $this->matricula;
  }

  public function arrancar()
  {
    echo 'Prendiendo motores';
    $this->encendido = true;
  }

  public function apagar()
  {
    echo 'Apagando motores';
    $this->$encendido = false;
  }
}


class Coche extends Vehiculo implements VehiculoBase
{
  public int $numeroPuertas;
  public bool $radioEncendida = false;
  const nPuertas = 4; // Constante número de puertas
  public static string $precio = '50.000€'; // Propiedad estática

  // Constructor sobrecargado
  public function __construct(string $marca, string $modelo, string $color, string $matricula) {
    parent::__construct($marca, $modelo, $color, $matricula);
    $this->numeroPuertas = self::nPuertas;
  }

  // Método sobrecargado
  public function arrancar(): void {
    parent::arrancar(); // Llama al método 'arrancar' del padre
    encenderRadio();
    echo "El automóvil $this->matricula $this->modelo ha arrancado.\n";
  }

  public function encenderRadio(): void {
    echo "La radio ha sido encendida.";
    $this->radioEncendida = true;
  }
}

abstract class Moto {
  // Métodos abstractos que debe de implementar la clase hijo
  abstract public function hacerCaballito();
  abstract protected function getMarca(): string;

  // Método 'final' que no se puede sobreescribir por un hijo
  public final function mostrarMarca() {
    print getMarca();
  }

}

class MotoHonda extends Moto {
  public function hacerCaballito() {
    echo "Estoy haciendo el caballito";
  }

  protected function getMarca(): string {
    return 'Honda';
  }
}

$vehiculoGenerico = new Vehiculo("Generico", "ModeloX", "Negro", "Q1212");
$coche = new Coche("Toyota", "Corolla", "Azul", "Q1212");
$moto = new MotoHonda();

$moto->hacerCaballito();

echo "precio: " . Coche::$precio;

$cadenaSerializada = serialize($coche);
print $cadenaSerializada;

?>
