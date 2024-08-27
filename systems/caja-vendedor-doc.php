<?php

class Transaction
{
    private TypeTransaction $type;
    private float $amout;

    function __construct(TypeTransaction $type, float $amout)
    {
        $this->type = $type;
        $this->amout = $amout;
    }

    public function getType(): string
    {
        return $this->type->value;
    }

    public function getAmount(): float 
    {
        return $this->amout;
    }
}

enum TypeTransaction: string
{
    case IN = 'IN';
    case OUT = 'OUT';
}

class CashBox
{
    private $iniAmount;
    private $endAmount;
    private $transactions;

    function __construct(float $iniAmount = 0)
    {
        $this->iniAmount = $iniAmount;
        $this->endAmount = $iniAmount;
        $this->transactions = [];
    }

    public function addTransaction(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;

        if($transaction->getType() == TypeTransaction::IN->value) {
            $this->endAmount += $transaction->getAmount();
        }

        if($transaction->getType() == TypeTransaction::OUT->value) {
            $this->endAmount -= $transaction->getAmount();
        }
    }
}

class Seller
{
    private $name; 
    private $assigDoc;

    function __construct($name)
    {
        $this->name = $name;
        $this->assigDoc = [];
    }

    public function assigDoc(AssignmentSerie $assignmentSerie): void
    {
        $this->assigDoc[] = $assignmentSerie;
    }

    public function sell(CashBox $cashbox, array $product, TypeDocument $typeDocument): void
    {

    }
}

class AssignmentSerie
{
    private TypeDocument $typeDocument;
    private string $serie;
    private int $correlative;

    function __construct(TypeDocument $typeDocument, string $serie, int $correlative = 1)
    {
        $this->typeDocument = $typeDocument;
        $this->serie = $serie;
        $this->correlative = $correlative;
    }

    public function consumeCorrelative()
    {
        $this->correlative += 1;
    }
}

enum TypeDocument: string 
{
    case BOLETA = 'BOLETA';
    case FACTURA = 'FACTURA';
}

# Aperturamos una caja
$caja01 = new CashBox(100);

# Tenemos a dos vendedores en la tienda
$mario = new Seller('Mario');
$ana = new Seller('Ana');

# Tengo solo un talonario de boletas y facturas
$assigBoleta = new AssignmentSerie(TypeDocument::BOLETA, 'B001');
$assigFactura = new AssignmentSerie(TypeDocument::FACTURA, 'F001');

# Asignacion de documentos a los vendedores
$mario->assigDoc($assigBoleta);
$mario->assigDoc($assigFactura);
$ana->assigDoc($assigBoleta);

# Mario va a vender dos productos y el cliente le solicito una factura
$mario->sell($caja01, ['product' => 'gaseosas', 'quantity' => 10, 'amount' => 100], TypeDocument::BOLETA);


