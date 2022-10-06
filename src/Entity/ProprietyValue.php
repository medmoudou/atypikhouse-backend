<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProprietyValueRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['read:propertyvalue']],
    denormalizationContext: ['groups' => ['write:propertyvalue']],
)]
#[ORM\Entity(repositoryClass: ProprietyValueRepository::class)]
class ProprietyValue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:propertyvalue', 'read:house'])]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    #[Groups(['read:propertyvalue', 'write:propertyvalue', 'read:house'])]
    private ?string $value = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read:propertyvalue', 'write:propertyvalue', 'read:house'])]
    private ?Propriety $propriety = null;

    #[ORM\ManyToOne(inversedBy: 'properties')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read:propertyvalue', 'write:propertyvalue'])]
    private ?House $house = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getPropriety(): ?Propriety
    {
        return $this->propriety;
    }

    public function setPropriety(?Propriety $propriety): self
    {
        $this->propriety = $propriety;

        return $this;
    }

    public function getHouse(): ?House
    {
        return $this->house;
    }

    public function setHouse(?House $house): self
    {
        $this->house = $house;

        return $this;
    }
}
