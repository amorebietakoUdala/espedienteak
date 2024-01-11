<?php

namespace App\Entity;

use App\Repository\PasosExpedientesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'pasosexpedientes')]
#[ORM\Entity(repositoryClass: PasosExpedientesRepository::class, readOnly: true)]
class PasosExpedientes
{
    #[ORM\Id]
    #[ORM\Column(name: 'kodea', type: 'string')]
    private $kodea;

    #[ORM\Column(name: 'numero', type: 'integer', nullable: true)]
    private $numero;

    #[ORM\Column(name: 'paso', type: 'integer', nullable: true)]
    private $paso;

    #[ORM\Column(name: 'departamento', type: 'string', length: 255, nullable: true)]
    private $departamento;

    #[ORM\Column(name: 'descripcion', type: 'string', length: 255, nullable: true)]
    private $descripcion;

    #[ORM\Column(name: 'plazo', type: 'string', length: 255, nullable: true)]
    private $plazo;

    #[ORM\Column(name: 'terminado', type: 'boolean')]
    private $terminado;

    #[ORM\Column(name: 'pasosiguiente', type: 'boolean')]
    private $pasosiguiente;

    #[ORM\Column(name: 'fechapaso', type: 'string', length: 255, nullable: true)]
    private $fechapaso;

    #[ORM\Column(name: 'publico', type: 'boolean')]
    private $publico;

    #[ORM\Column(name: 'plantilla', type: 'string', length: 255, nullable: true)]
    private $plantilla;

    #[ORM\Column(name: 'condto', type: 'boolean')]
    private $condto;

    #[ORM\Column(name: 'documentocreado', type: 'boolean', nullable: true)]
    private $documentocreado;

    #[ORM\ManyToOne(targetEntity: RegExpedientes::class, inversedBy: 'pasosExpedientes')]
    #[ORM\JoinColumn(name: 'numeroExpediente', referencedColumnName: 'kodea', nullable: false)]
    private $expediente;

    public function getKodea(): ?string
    {
        return $this->kodea;
    }

    public function setKodea(string $kodea): self
    {
        $this->kodea = $kodea;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(?int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getPaso(): ?int
    {
        return $this->paso;
    }

    public function setPaso(?int $paso): self
    {
        $this->paso = $paso;

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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getPlazo(): ?string
    {
        return $this->plazo;
    }

    public function setPlazo(?string $plazo): self
    {
        $this->plazo = $plazo;

        return $this;
    }

    public function isTerminado(): ?bool
    {
        return $this->terminado;
    }

    public function setTerminado(bool $terminado): self
    {
        $this->terminado = $terminado;

        return $this;
    }

    public function isPasosiguiente(): ?bool
    {
        return $this->pasosiguiente;
    }

    public function setPasosiguiente(bool $pasosiguiente): self
    {
        $this->pasosiguiente = $pasosiguiente;

        return $this;
    }

    public function getFechapaso(): ?string
    {
        return $this->fechapaso;
    }

    public function setFechapaso(?string $fechapaso): self
    {
        $this->fechapaso = $fechapaso;

        return $this;
    }

    public function isPublico(): ?bool
    {
        return $this->publico;
    }

    public function setPublico(bool $publico): self
    {
        $this->publico = $publico;

        return $this;
    }

    public function getPlantilla(): ?string
    {
        return $this->plantilla;
    }

    public function setPlantilla(?string $plantilla): self
    {
        $this->plantilla = $plantilla;

        return $this;
    }

    public function isCondto(): ?bool
    {
        return $this->condto;
    }

    public function setCondto(bool $condto): self
    {
        $this->condto = $condto;

        return $this;
    }

    public function isDocumentocreado(): ?bool
    {
        return $this->documentocreado;
    }

    public function setDocumentocreado(?bool $documentocreado): self
    {
        $this->documentocreado = $documentocreado;

        return $this;
    }

    public function getExpediente(): ?RegExpedientes
    {
        return $this->expediente;
    }

    public function setExpediente(?RegExpedientes $expediente): self
    {
        $this->expediente = $expediente;

        return $this;
    }

    public function getNombreDocumento(): string {
        return "{$this->departamento}-{$this->getExpediente()->getTipoexpediente()}-{$this->paso}-{$this->getExpediente()}.doc";
    }

    public function getRutaDocumento($base): string {
        $expediente = $this->getExpediente();
        return "$base/{$this->departamento}/{$expediente->getAño()}/{$this->getNombreDocumento()}";
    }
}
