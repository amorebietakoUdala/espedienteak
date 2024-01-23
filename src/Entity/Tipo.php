<?php

namespace App\Entity;

use App\Repository\TipoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'Tipo')]
#[ORM\Entity(repositoryClass: TipoRepository::class, readOnly: true)]
class Tipo implements \Stringable
{
    public const TIPO_ENTRADA=0;
    public const TIPO_SALIDA=1;
    public const TIPO_OFICIO=2;

    #[ORM\Id]
    #[ORM\Column(name: 'Codigo', type: 'integer')]
    private $id;

    #[ORM\Column(name: 'Descripcion_Tipo', type: 'string', length: 15)]
    private $descripcion;

    #[ORM\OneToMany(mappedBy: 'tipo', targetEntity: Registro::class)]
    private Collection $registros;

    public function __construct()
    {
        $this->registros = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->descripcion;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function addRegistro(Registro $registro): static
    {
        if (!$this->registros->contains($registro)) {
            $this->registros->add($registro);
            $registro->setTipo($this);
        }

        return $this;
    }

    public function removeRegistro(Registro $registro): static
    {
        if ($this->registros->removeElement($registro)) {
            // set the owning side to null (unless already changed)
            if ($registro->getTipo() === $this) {
                $registro->setTipo(null);
            }
        }

        return $this;
    }
}
