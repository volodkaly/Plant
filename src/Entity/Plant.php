<?php

namespace App\Entity;

use App\Repository\PlantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlantRepository::class)]
class Plant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $minNumberOfDaysToWater = 2;

    #[ORM\Column]
    private ?int $maxNumberOfDaysToWater = 20;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $fertilizers = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMinNumberOfDaysToWater(): ?int
    {
        return $this->minNumberOfDaysToWater;
    }

    public function setMinPeriodToWater(int $minNumberOfDaysToWater): static
    {
        $this->minNumberOfDaysToWater = $minNumberOfDaysToWater;

        return $this;
    }

    public function getMaxNumberOfDaysToWater(): ?int
    {
        return $this->maxNumberOfDaysToWater;
    }

    public function setMaxNumberOfDaysToWater(int $maxNumberOfDaysToWater): static
    {
        $this->maxNumberOfDaysToWater = $maxNumberOfDaysToWater;

        return $this;
    }

    public function getFertilizers(): ?array
    {
        return $this->fertilizers;
    }

    public function setFertilizers(?array $fertilizers): static
    {
        $this->fertilizers = $fertilizers;

        return $this;
    }
}
