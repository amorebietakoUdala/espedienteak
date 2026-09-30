<?php

namespace App\Entity;

use App\Repository\SearchHistoricRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SearchHistoricRepository::class)]
class SearchHistoric
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1024)]
    private ?string $details = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): static
    {
        $this->details = $details;

        return $this;
    }

    public static function createFromArray(array $data) {
        $searchHistoric = new self();
        $searchHistoric->setDetails(json_encode($data));
        return $searchHistoric;
    }
}
