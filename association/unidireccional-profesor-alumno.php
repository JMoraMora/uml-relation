<?php

# Relacion unidireccional donde el profesor asigna notas al alumno pero el alumno desconoce o no tiene conocimiento de la forma en como lo evaluara el profesor.

# clase origen profesor
# clase destino alumno

class Profesor
{
    private string $nombre;
    
    function __construct(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function asignarCalificacion(Alumno $alumno, int $calificacion): void
    {
        $alumno->setCalificacion($calificacion);
    }
}

class Alumno
{
    private string $nombre;
    private int $calificacion;

    function __construct(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function setCalificacion(int $calificacion): void    
    {
        $this->calificacion = $calificacion;
    }

    public function getCalificacion(): int
    {
        return $this->calificacion;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }
}

# En este ejemplo como se puede ver vamos a inyectar por medio del argumento de funcion la clase alumno
$profesorMarco = new Profesor('Marco Gonzales');

$alumnoPedro = new Alumno('Pedro');
$alumnoMaria = new Alumno('Maria');
$alumnoAna = new Alumno('Ana');
$alumnoRoberto = new Alumno('Roberto');

# El profesor toma un examen en un contexto real y luego registra las notas de sus alumnos en el sistema
$profesorMarco->asignarCalificacion($alumnoPedro, 14);
$profesorMarco->asignarCalificacion($alumnoMaria, 13);
$profesorMarco->asignarCalificacion($alumnoAna, 20);
$profesorMarco->asignarCalificacion($alumnoRoberto, 17);

# Imprimir resultados
echo "Profesor: " . $profesorMarco->getNombre() . "\n\v";

# Cada alumno puede acceder a sus calificaciones
echo <<<EOT
Alumnos
--------------------------
{$alumnoPedro->getNombre()} - {$alumnoPedro->getCalificacion()}
{$alumnoMaria->getNombre()} - {$alumnoMaria->getCalificacion()}
{$alumnoAna->getNombre()} - {$alumnoAna->getCalificacion()}
{$alumnoRoberto->getNombre()} - {$alumnoRoberto->getCalificacion()}

EOT;

# En este ejemplo como se puede ver tenemos una asociacion de tipo unidireccional, donde la flecha va desde el profesor al alumno 
# Profesor ------> Alumno
# Entonces el profesor puede acceder a las propiedades y metodos del alumno, mas no eso no se puede hacer en viceversa. Y si lo planteas en un contexto real
# el profesor tiene un listado con los datos de sus alumnos, el sabe y conoce a cada alumno, mas no los alumnos pueden saber ciertos detalles del profesor
# el profesor tiene distintas actividades que el alumno pero en una jerarquia el profesor esta por encima por que tiene poder de cambiar ciertos atributos al alumno
# como este caso, este le asigna las notas a sus alumnos.