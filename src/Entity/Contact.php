<?php

namespace App\Entity;

use App\Enum\ContactPersonType;
use App\Enum\ContactReason;
use App\Enum\ContactTechStaffReason;
use App\Repository\ContactRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $subject = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\Column(length: 20)]
    private string $visitor;

    #[ORM\Column(length: 20, nullable: true)]
    private string $kind;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getVisitor(): ?ContactPersonType
    {
        return $this->visitor;
    }

    public function setVisitor(ContactPersonType $visitor): static
    {
        $this->visitor = $visitor->value;

        return $this;
    }

    public function getKind(): ContactTechStaffReason|ContactReason
    {
        return $this->kind->value;
    }

    public function setKind(ContactTechStaffReason|ContactReason $kind): static
    {
        $this->kind = $kind->value;

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
    #[ORM\PrePersist]
    public function onPrePersist()
    {
        $this->setCreatedAt(new DateTimeImmutable("now"));
    }
}
