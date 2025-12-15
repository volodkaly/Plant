<?php

namespace App\Entity;

use App\Repository\PlantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    #[Assert\PositiveOrZero]
    private ?int $minNumberOfDaysToWater = 2;

    #[ORM\Column]
    #[Assert\PositiveOrZero]
    #[Assert\GreaterThanOrEqual(propertyPath: "minNumberOfDaysToWater", message: "The value should be greater than min number of days to water or equal")]
    private ?int $maxNumberOfDaysToWater = 20;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $fertilizers = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $lastWateringDate = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt;

    #[ORM\Column(nullable: true)]
    #[Assert\PositiveOrZero]
    #[Assert\LessThan(20000)]
    private ?int $height = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero]
    private ?int $volumeOfWaterInMLperCMofHeight = null;

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

    public function setMinNumberOfDaysToWater(int $minNumberOfDaysToWater): static
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

    public function getLastWateringDate(): ?\DateTime
    {
        return $this->lastWateringDate;
    }

    public function setLastWateringDate(?\DateTime $lastWateringDate): static
    {
        $this->lastWateringDate = $lastWateringDate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getMaxDaysTillNextWatering(): int
    {
        $today = new \DateTime();
        $last = $this->lastWateringDate ?? $this->createdAt;

        $maxNext = (clone $last)->modify('+' . $this->getMaxNumberOfDaysToWater() . ' days');
        if ($maxNext < $today) {
            return 0;
        }

        $maxDiff = $today->diff($maxNext)->days;
        return (int) $maxDiff;

    }

    public function getNextWatering(): string
    {
        $today = new \DateTime();
        $last = $this->lastWateringDate ?? $this->createdAt;

        $minNext = (clone $last)->modify('+' . $this->getMinNumberOfDaysToWater() . ' days');
        $maxNext = (clone $last)->modify('+' . $this->getMaxNumberOfDaysToWater() . ' days');

        $minDiff = max(0, $today->diff($minNext)->days);
        $maxDiff = $today->diff($maxNext)->days;

        if ($minDiff == $maxDiff) {
            return "$minDiff";
        }

        return "$minDiff - $maxDiff";
    }

    public function getVolumeOfWaterInMLperCMofHeight(): ?int
    {
        return $this->volumeOfWaterInMLperCMofHeight;
    }

    public function setVolumeOfWaterInMLperCMofHeight(int $volumeOfWaterInMLperCMofHeight): static
    {
        $this->volumeOfWaterInMLperCMofHeight = $volumeOfWaterInMLperCMofHeight;

        return $this;
    }

    public function getVolumeOfWaterInML(): ?int
    {
        return ($this->getVolumeOfWaterInMLperCMofHeight()) * ($this->getHeight());
    }

}
