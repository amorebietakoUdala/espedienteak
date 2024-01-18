<?php

namespace App\Entity;

use App\Repository\RegistroRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'REGISTRO')]
#[ORM\Entity(repositoryClass: RegistroRepository::class, readOnly: true)]
class Registro implements \Stringable
{
    #[ORM\ManyToOne(inversedBy: 'registros')]
    #[ORM\JoinColumn(name: 'TIPO', referencedColumnName: 'Codigo', nullable: true)]
    private ?Tipo $tipo = null;

    #[ORM\Column(name: 'orden_entrada_salida', type: 'decimal')]
    private $ordenEntradaSalida;

    #[ORM\Column(name: 'anno', type: 'string', length: 2, nullable: true)]
    private $anno;

    #[ORM\Column(name: 'departamento', type: 'string', length: 4, nullable: true)]
    private $departamento;

    #[ORM\Column(name: 'fecha_entrada', type: 'datetime', nullable: true)]
    private $fechaEntrada;

    #[ORM\Column(name: 'descripcion', type: 'string', length: 4096, nullable: true)]
    private $descripcion;

    #[ORM\Column(name: 'direccionObjetoTributario', type: 'string', length: 32, nullable: true)]
    private $direccionObjetoTributario;

    #[ORM\Column(name: 'poblacionObjetoTributario', type: 'string', length: 28, nullable: true)]
    private $poblacionObjetoTributario;

    #[ORM\Column(name: 'dni', type: 'string', length: 10, nullable: true)]
    private $dni;

    #[ORM\Column(name: 'telefono', type: 'string', length: 10, nullable: true)]
    private $telefono;

    #[ORM\Column(name: 'solicitante', type: 'string', length: 50, nullable: true)]
    private $solicitante;

    #[ORM\Column(name: 'direccion', type: 'string', length: 50, nullable: true)]
    private $direccion;

    #[ORM\Column(name: 'poblacion', type: 'string', length: 28, nullable: true)]
    private $poblacion;

    #[ORM\Column(name: 'provincia', type: 'string', length: 5, nullable: true)]
    private $provincia;

    #[ORM\Column(name: 'observaciones', type: 'string', length: 4096, nullable: true)]
    private $observaciones;

    #[ORM\Column(name: 'fecha_documento', type: 'datetime', nullable: true)]
    private $fechaDocumento;

    #[ORM\Id]
    #[ORM\Column(name: 'numero_texto', type: 'string', length: 28, nullable: true)]
    private $id;

    #[ORM\Column(name: 'representante', type: 'string', length: 50, nullable: true)]
    private $representante;

    #[ORM\Column(name: 'direc_representante', type: 'string', length: 50, nullable: true)]
    private $dirRepresentante;

    #[ORM\Column(name: 'poblacion_representante', type: 'string', length: 28, nullable: true)]
    private $poblacionRepresentante;

    #[ORM\Column(name: 'provincia_representante', type: 'string', length: 5, nullable: true)]
    private $provinciaRepresentante;

    #[ORM\Column(name: 'recogido', type: 'boolean', nullable: false)]
    private $recogido;

    #[ORM\Column(name: 'hora', type: 'string', length: 50, nullable: true)]
    private $hora;

    #[ORM\Column(name: 'factura', type: 'boolean', nullable: false)]
    private $factura;

    #[ORM\Column(name: 'email', type: 'string', length: 50, nullable: true)]
    private $email;

    #[ORM\Column(name: 'usuario', type: 'string', length: 30, nullable: true)]
    private $usuario;

    #[ORM\Column(name: 'importe', type: 'string', length: 50, nullable: true)]
    private $importe;

    #[ORM\Column(name: 'dtoDoc', type: 'string', length: 4, nullable: true)]
    private $dtoDoc;

    #[ORM\Column(name: 'privado', type: 'decimal', nullable: true)]
    private $privado;

    #[ORM\ManyToOne(inversedBy: 'registros')]
    #[ORM\JoinColumn(name: 'NumeroExpediente', referencedColumnName: 'kodea', nullable: true)]
    private ?RegExpedientes $expediente = null;

    public function __toString(): string
    {
        return $this->id.' '.$this->descripcion;
    }

    public function getTipo(): ?Tipo
    {
        return $this->tipo;
    }

    public function setTipo(?Tipo $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getOrdenEntradaSalida(): float
    {
        return $this->ordenEntradaSalida;
    }

    public function setOrdenEntradaSalida($ordenEntradaSalida): self
    {
        $this->ordenEntradaSalida = $ordenEntradaSalida;

        return $this;
    }

    public function getAnno(): string
    {
        return $this->anno;
    }

    public function setAnno($anno): self
    {
        $this->anno = $anno;

        return $this;
    }

    public function getDepartamento(): string
    {
        return $this->departamento;
    }

    public function setDepartamento($departamento): self
    {
        $this->departamento = $departamento;

        return $this;
    }

    public function getFechaEntrada(): \DateTime
    {
        return $this->fechaEntrada;
    }

    public function setFechaEntrada($fechaEntrada): self
    {
        $this->fechaEntrada = $fechaEntrada;

        return $this;
    }

    public function getDescripcion():string
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getDireccionObjetoTributario(): string
    {
        return $this->direccionObjetoTributario;
    }

    public function setDireccionObjetoTributario($direccionObjetoTributario): self
    {
        $this->direccionObjetoTributario = $direccionObjetoTributario;

        return $this;
    }

    public function getPoblacionObjetoTributario(): string
    {
        return $this->poblacionObjetoTributario;
    }

    public function setPoblacionObjetoTributario($poblacionObjetoTributario): self
    {
        $this->poblacionObjetoTributario = $poblacionObjetoTributario;

        return $this;
    }

    public function getDni(): string
    {
        return $this->dni;
    }

    public function setDni($dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getTelefono(): string
    {
        return $this->telefono;
    }

    public function setTelefono($telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getSolicitante(): string
    {
        return $this->solicitante;
    }

    public function setSolicitante($solicitante): self
    {
        $this->solicitante = $solicitante;

        return $this;
    }

    public function getDireccion(): string
    {
        return $this->direccion;
    }

    public function setDireccion($direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getPoblacion(): string
    {
        return $this->poblacion;
    }

    public function setPoblacion($poblacion): self
    {
        $this->poblacion = $poblacion;

        return $this;
    }

    public function getProvincia(): string
    {
        return $this->provincia;
    }

    public function setProvincia($provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

    public function getObservaciones(): string
    {
        return $this->observaciones;
    }

    public function setObservaciones($observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    public function getFechaDocumento(): \DateTime
    {
        return $this->fechaDocumento;
    }

    public function setFechaDocumento($fechaDocumento): self
    {
        $this->fechaDocumento = $fechaDocumento;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getRepresentante(): string
    {
        return $this->representante;
    }

    public function setRepresentante($representante): self
    {
        $this->representante = $representante;

        return $this;
    }

    public function getDirRepresentante(): string
    {
        return $this->dirRepresentante;
    }

    public function setDirRepresentante($dirRepresentante): self
    {
        $this->dirRepresentante = $dirRepresentante;

        return $this;
    }

    public function getPoblacionRepresentante(): string
    {
        return $this->poblacionRepresentante;
    }

    public function setPoblacionRepresentante($poblacionRepresentante): self
    {
        $this->poblacionRepresentante = $poblacionRepresentante;

        return $this;
    }

    public function getProvinciaRepresentante(): string
    {
        return $this->provinciaRepresentante;
    }

    public function setProvinciaRepresentante($provinciaRepresentante): self
    {
        $this->provinciaRepresentante = $provinciaRepresentante;

        return $this;
    }

    public function getRecogido(): bool
    {
        return $this->recogido;
    }

    public function setRecogido($recogido): self
    {
        $this->recogido = $recogido;

        return $this;
    }

    public function getHora(): string
    {
        return $this->hora;
    }

    public function setHora($hora): self
    {
        $this->hora = $hora;

        return $this;
    }

    public function getFactura(): bool
    {
        return $this->factura;
    }

    public function setFactura($factura): self
    {
        $this->factura = $factura;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsuario(): string
    {
        return $this->usuario;
    }

    public function setUsuario($usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getImporte(): string
    {
        return $this->importe;
    }

    public function setImporte($importe): self
    {
        $this->importe = $importe;

        return $this;
    }

    public function getDtoDoc(): string
    {
        return $this->dtoDoc;
    }

    public function setDtoDoc($dtoDoc): self
    {
        $this->dtoDoc = $dtoDoc;

        return $this;
    }

    public function getPrivado(): float
    {
        return $this->privado;
    }

    public function setPrivado($privado): self
    {
        $this->privado = $privado;

        return $this;
    }

    public function getExpediente(): ?RegExpedientes
    {
        return $this->expediente;
    }

    public function setExpediente(?RegExpedientes $expediente): static
    {
        $this->expediente = $expediente;

        return $this;
    }

    public function getNameFilter(): string {
        return "{$this->getId()}";
    }

    public function getMonth() : string {
        setlocale(LC_TIME, 'es_ES.UTF-8');
        $month = strftime('%B', strtotime(($this->fechaEntrada)->format('Y-m-d')));
        return ucfirst($month);
    }

    public function getRelativePath(): string {
        $path = $this->getAnno().'/'.$this->getTipo().'s/'.$this->getMonth();
        if ($this->getTipo()->getId() === 2) {
            $path = $this->getTipo().'s/'.$this->getAnno();
        }
        return $path;
    }

    public function getRutaEntrada(string $base): string {
        return "$base/{$this->getRelativePath()}/";
    }

    public function getPattern(): string {
        $pattern = '*.TIF';
        if ( $this->getTipo()->getId() === 2 ) {
            $pattern = '*.doc';
        }
        return $pattern;
    }
}
