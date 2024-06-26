<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Patch;
use App\Repository\ReviewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[
    ApiResource(
        operations: [
            new Post(
                security: "is_granted('ROLE_USER')",
            ),
            new Get(),
            new GetCollection(),
            new Patch(
                security: "is_granted('ROLE_ADMIN') or object.getUser() == user",
            ),
            new Delete(
                security: "is_granted('ROLE_ADMIN') or object.getUser() == user",
            ),
        ],
        normalizationContext: ['groups' => ['read:review']],
        denormalizationContext: ['groups' => ['write:review', 'write:user', 'write:house']],
    ),
    ApiFilter(
        SearchFilter::class,
        properties: [
            'user.id' => SearchFilter::STRATEGY_EXACT,
            'house.id' => SearchFilter::STRATEGY_EXACT,
        ]
    ),
]
#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:review', 'read:user'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Groups(['read:review', 'write:review', 'read:user', 'read:housecollcetion'])]
    #[Assert\NotBlank]
    private ?int $grade = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['read:review', 'write:review', 'read:user'])]
    #[Assert\NotBlank]
    private ?string $comment = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read:review', 'write:review', 'write:user', 'read:user'])]
    #[Assert\NotNull]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read:review', 'write:review', 'read:user'])]
    #[Assert\NotNull]
    private ?House $house = null;

    #[ORM\Column]
    #[Groups(['read:review', 'read:user'])]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrade(): ?int
    {
        return $this->grade;
    }

    public function setGrade(int $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

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
}
