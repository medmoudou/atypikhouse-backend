<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Patch;
use App\Controller\BookingController;
use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[
    ApiResource(
        operations: [
            new Post(
                controller: BookingController::class,
                deserialize: false,
                security: "is_granted('ROLE_USER')",
            ),
            new Get(
                security: "is_granted('ROLE_ADMIN') or object.user == user",
            ),
            new GetCollection(
                security: "is_granted('ROLE_USER')",
            ),
            new Patch(
                controller: BookingController::class,
                security: "is_granted('ROLE_ADMIN') or object.getHouse().owner == user",
            ),
            // new Delete(
            //     security: "is_granted('ROLE_ADMIN') or object.user == user",
            // ),
        ],
        normalizationContext: ['groups' => ['read:reservation']],
        denormalizationContext: ['groups' => ['write:reservation']],
    ),
    ApiFilter(
        SearchFilter::class,
        properties: [
            'user.id' => SearchFilter::STRATEGY_EXACT,
            'house.id' => SearchFilter::STRATEGY_EXACT,
            'status' => SearchFilter::STRATEGY_EXACT,
        ]
    ),
    ApiFilter(OrderFilter::class, properties: ['createdAt', 'fromDate', 'toDate'])
]
#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:reservation', 'write:reservation', 'read:user'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['read:reservation', 'write:reservation', 'read:user'])]
    #[Assert\NotBlank]
    private ?float $amount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['read:reservation', 'write:reservation', 'read:user'])]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $fromDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['read:reservation', 'write:reservation', 'read:user'])]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $toDate = null;

    #[ORM\Column]
    #[Groups(['read:reservation', 'write:reservation', 'read:user'])]
    #[Assert\NotBlank]
    private ?int $nbPersons = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read:reservation', 'write:reservation'])]
    #[Assert\NotNull]
    public ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read:reservation', 'write:reservation', 'read:user'])]
    #[Assert\NotNull]
    private ?House $house = null;

    #[ORM\Column]
    #[Groups(['read:reservation', 'read:user'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:reservation', 'write:reservation', 'read:user'])]
    private ?string $status = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getFromDate(): ?\DateTimeInterface
    {
        return $this->fromDate;
    }

    public function setFromDate(\DateTimeInterface $fromDate): self
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    public function getToDate(): ?\DateTimeInterface
    {
        return $this->toDate;
    }

    public function setToDate(\DateTimeInterface $toDate): self
    {
        $this->toDate = $toDate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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

    public function getNbPersons(): ?int
    {
        return $this->nbPersons;
    }

    public function setNbPersons(int $nbPersons): self
    {
        $this->nbPersons = $nbPersons;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
