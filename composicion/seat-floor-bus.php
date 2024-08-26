<?php 

# En este ejemplo haremos uso de las relaciones de tipo composicion.
# en el caso de las relaciones de tipo composicion estas son requeridas para el ciclo de vida de una clase,  ya que la compone

class Seat 
{
    public $number;
    public $disponibility;

    function __construct(int $number)
    {
        $this->number = $number;
        $this->disponibility = true;
    }
}

class Floor 
{
    public $numberFloor;
    public $seats;

    function __construct(int $numberFloor, int $seats)
    {
        $this->numberFloor = $numberFloor;
        $this->seats = [];
        for ($i = 1; $i <= $seats; $i++) {
            $this->seats[] = new Seat($i);
        }
    }
}

class Bus 
{
    public $id;
    public $floors;

    public function __construct($id, $floors) {
        $this->id = $id;
        $this->floors = [];
        foreach ($floors as $numberFloor => $quantitySeats) {
            $this->floors[] = new Floor($numberFloor, $quantitySeats);
        }
    }
}

# De esta forma tenemos la clase bus que se compone por piso y la clase piso se compone por asientos
$busAF001 = new Bus('AF001', [ 1 => 30]);

echo '<pre>' . print_r($busAF001, true) . '</pre>';die;