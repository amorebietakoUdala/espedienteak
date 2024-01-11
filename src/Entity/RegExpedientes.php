<?php

namespace App\Entity;

use App\Repository\RegExpedientesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'regexpedientes')]
#[ORM\Entity(repositoryClass: RegExpedientesRepository::class, readOnly: true)]
class RegExpedientes implements \Stringable
{
    #[ORM\Id]
    #[ORM\Column(name: 'kodea', type: 'string')]
    private $id;

    #[ORM\Column(name: 'numero', type: 'integer')]
    private $numero;

    #[ORM\Column(name: 'descripcion', type: 'string', length: 255, nullable: true)]
    private $descripcion;

    #[ORM\Column(name: 'solicitante', type: 'string', length: 255, nullable: true)]
    private $solicitante;

    #[ORM\Column(name: 'dni', type: 'string', length: 255, nullable: true)]
    private $dni;

    #[ORM\Column(name: 'fechaentrada', type: 'datetime', nullable: true)]
    private $fechaentrada;

    #[ORM\Column(name: 'fechafinalizacion', type: 'datetime', nullable: true)]
    private $fechafinalizacion;

    #[ORM\Column(name: 'tipoexpediente', type: 'integer', nullable: true)]
    private $tipoexpediente;

    #[ORM\Column(name: 'numeroexpediente', type: 'integer', nullable: true)]
    private $numeroexpediente;

    #[ORM\Column(name: 'finalizado', type: 'boolean')]
    private $finalizado;

    #[ORM\Column(name: 'año', type: 'string', length: 255, nullable: true)]
    private $año;

    #[ORM\Column(name: 'departamento', type: 'string', length: 255, nullable: true)]
    private $departamento;

    #[ORM\Column(name: 'documento', type: 'boolean')]
    private $documento;

    #[ORM\Column(name: 'expedienterelacionado', type: 'string', length: 255, nullable: true)]
    private $expendienterelacionado;

    #[ORM\Column(name: 'UltimoPaso', type: 'string', length: 255, nullable: true)]
    private $ultimopaso;

    #[ORM\Column(name: 'Factura', type: 'boolean')]
    private $factura;

    #[ORM\Column(name: 'Archivado', type: 'boolean')]
    private $archivado;

    #[ORM\Column(name: 'ExpePara', type: 'boolean')]
    private $expepara;

    #[ORM\Column(name: 'privado', type: 'float', nullable: true)]
    private $privado;

    #[ORM\OneToMany(targetEntity: PasosExpedientes::class, mappedBy: 'expediente')]
    private $pasosExpedientes;

    public function __construct()
    {
        $this->pasosExpedientes = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setKodea(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getSolicitante(): ?string
    {
        return $this->solicitante;
    }

    public function setSolicitante(?string $solicitante): self
    {
        $this->solicitante = $solicitante;

        return $this;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(?string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getFechaentrada(): ?\DateTimeInterface
    {
        return $this->fechaentrada;
    }

    public function setFechaentrada(?\DateTimeInterface $fechaentrada): self
    {
        $this->fechaentrada = $fechaentrada;

        return $this;
    }

    public function getFechafinalizacion(): ?\DateTimeInterface
    {
        return $this->fechafinalizacion;
    }

    public function setFechafinalizacion(?\DateTimeInterface $fechafinalizacion): self
    {
        $this->fechafinalizacion = $fechafinalizacion;

        return $this;
    }

    public function getTipoexpediente(): ?int
    {
        return $this->tipoexpediente;
    }

    public function setTipoexpediente(?int $tipoexpediente): self
    {
        $this->tipoexpediente = $tipoexpediente;

        return $this;
    }

    public function getNumeroexpediente(): ?int
    {
        return $this->numeroexpediente;
    }

    public function setNumeroexpediente(?int $numeroexpediente): self
    {
        $this->numeroexpediente = $numeroexpediente;

        return $this;
    }

    public function isFinalizado(): ?bool
    {
        return $this->finalizado;
    }

    public function setFinalizado(bool $finalizado): self
    {
        $this->finalizado = $finalizado;

        return $this;
    }

    public function getAño(): ?string
    {
        return $this->año;
    }

    public function setAño(?string $año): self
    {
        $this->año = $año;

        return $this;
    }

    public function getDepartamento(): ?string
    {
        return $this->departamento;
    }

    public function setDepartamento(?string $departamento): self
    {
        $this->departamento = $departamento;

        return $this;
    }

    public function isDocumento(): ?bool
    {
        return $this->documento;
    }

    public function setDocumento(bool $documento): self
    {
        $this->documento = $documento;

        return $this;
    }

    public function getExpendienterelacionado(): ?string
    {
        return $this->expendienterelacionado;
    }

    public function setExpendienterelacionado(?string $expendienterelacionado): self
    {
        $this->expendienterelacionado = $expendienterelacionado;

        return $this;
    }

    public function getUltimopaso(): ?string
    {
        return $this->ultimopaso;
    }

    public function setUltimopaso(?string $ultimopaso): self
    {
        $this->ultimopaso = $ultimopaso;

        return $this;
    }

    public function isFactura(): ?bool
    {
        return $this->factura;
    }

    public function setFactura(bool $factura): self
    {
        $this->factura = $factura;

        return $this;
    }

    public function isArchivado(): ?bool
    {
        return $this->archivado;
    }

    public function setArchivado(bool $archivado): self
    {
        $this->archivado = $archivado;

        return $this;
    }

    public function isExpepara(): ?bool
    {
        return $this->expepara;
    }

    public function setExpepara(bool $expepara): self
    {
        $this->expepara = $expepara;

        return $this;
    }

    public function getPrivado(): ?float
    {
        return $this->privado;
    }

    public function setPrivado(?float $privado): self
    {
        $this->privado = $privado;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->id;   
    }

    /**
     * @return Collection<int, PasosExpedientes>
     */
    public function getPasosExpedientes(): Collection
    {
        return $this->pasosExpedientes;
    }

    public function addPasosExpediente(PasosExpedientes $pasosExpediente): self
    {
        if (!$this->pasosExpedientes->contains($pasosExpediente)) {
            $this->pasosExpedientes[] = $pasosExpediente;
            $pasosExpediente->setExpediente($this);
        }

        return $this;
    }

    public function removePasosExpediente(PasosExpedientes $pasosExpediente): self
    {
        if ($this->pasosExpedientes->removeElement($pasosExpediente)) {
            // set the owning side to null (unless already changed)
            if ($pasosExpediente->getExpediente() === $this) {
                $pasosExpediente->setExpediente(null);
            }
        }

        return $this;
    }
}
