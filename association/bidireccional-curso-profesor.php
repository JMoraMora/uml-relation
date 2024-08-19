<?php 

# En este ejemplo sabemos que un profesor puede impartir uno o varios cursos de acuerdo a su especialidad
# Y a su vez un curso puede ser impartido por uno o mas profesores.

# > Nota: Tener en cuenta que cardinalidad no es lo mismo que multiplicidad, por lo tanto no estamos hablando de una relacion de mucho a muchos
# Si no de una relacion asociativa bidireccional, donde cada objeto de una clase se comunicara con el otro objeto de la otra clase.

class Profesor
{
    private string $nombre;
    private array $especialidad; 
    private array $cursos;

    function __construct(string $nombre, array $especialidad)
    {
        $this->nombre = $nombre;
        $this->especialidad = $especialidad;
        $this->cursos = [];
    }

    public function asignacionCurso(Curso $curso): void
    {
        // var_dump($curso);die;
        array_push($this->cursos, $curso);
        $curso->addProfesor($this);
    }

    public function getNombre(): string 
    {
        return $this->nombre;
    }

    public function getEspecialidad(): array 
    {
        return $this->especialidad;
    }

    public function getCursos(): array 
    {
        return $this->cursos;
    }
}

class Curso 
{
    private string $nombre;
    private array $profesores;

    function __construct(string $nombre)
    {
        $this->nombre = $nombre;
        $this->profesores = [];
    }

    public function addProfesor(Profesor $profesor): void
    {
        array_push($this->profesores, $profesor);
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getProfesores(): array
    {
        return $this->profesores;
    }
}

# En este ejemplo, supongamos que somos un instituto con diez profesores, y solo se enseñan cinco materias: diseño grafico, programacion, administracion de base de datos,
# contabilidad y ingles. 
$contabilidad = new Curso('contabilidad');
$basededatos = new Curso('basededatos');
$design = new Curso('design');
$programacion = new Curso('programacion');
$ingles = new Curso('ingles');

# profesor del instituto y sus especialidades
$profesorMarco = new Profesor('Marco', ['bilingue']);
$profesorMarco->asignacionCurso($ingles);

$profesorAna = new Profesor('Ana', ['programador backend', 'programador frontend']);
$profesorAna->asignacionCurso($programacion);
$profesorAna->asignacionCurso($design);

$profesorMaria = new Profesor('Maria', ['devop']);
$profesorMaria->asignacionCurso($programacion);

$profesorPedro = new Profesor('Pedro', ['diseñador grafico']);
$profesorPedro->asignacionCurso($design);

$profesorMario = new Profesor('Mario', ['diseñador web']);
$profesorMario->asignacionCurso($design);
$profesorMario->asignacionCurso($programacion);

$profesorRosio = new Profesor('Rosio', ['contador y administrador de empresas']);
$profesorRosio->asignacionCurso($contabilidad);

$profesorAlex = new Profesor('Alex', ['bilingue', 'contador tributario']);
$profesorAlex->asignacionCurso($ingles);
$profesorAlex->asignacionCurso($contabilidad);

$profesorCarlos = new Profesor('Carlos', ['administrador de base de datos', 'programador backend']);
$profesorCarlos->asignacionCurso($programacion);
$profesorCarlos->asignacionCurso($basededatos);

$profesorRoberto = new Profesor('Roberto', ['diseño web', 'arquitecto de software']);
$profesorRoberto->asignacionCurso($design);
$profesorRoberto->asignacionCurso($basededatos);

# Luego de definir sus clases y en este caso los objetos instanciados de estos, podemos acceder a los comportamientos de los otros objetos, por que la asociacion
# es bidireccional 

# Yo puedo listar resultados, tanto desde los cursos, como desde los profesores. 
# listado desde cursos 
/**
echo "Curso: " . $contabilidad->getNombre() . "\n";
echo "Profesores\n"; 
echo "----------\n";
foreach ($contabilidad->getProfesores() as $profesor) { 
    $nombre = $profesor->getNombre(); 
    $especialidades = implode($profesor->getEspecialidad());
    echo "$nombre - Especialidades [$especialidades]\n";
}
echo "\n";
 */

# listado desde profesor
echo "Profesor: " . $profesorCarlos->getNombre() . "\n";
echo "Cursos impartidos\n";
echo "-----------------\n";
foreach($profesorCarlos->getCursos() as $curso) {
    echo $curso->getNombre() . "\n";
}
echo "\n";
