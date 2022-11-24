<?php

namespace App\Entity;

use App\Repository\ProfessionalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfessionalRepository::class)]
class Professional
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $companyName = null;

    #[ORM\Column(length: 9)]
    private ?string $duns = null;

    #[ORM\OneToOne(mappedBy: 'professional', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getDuns(): ?string
    {
        return $this->duns;
    }

    public function setDuns(string $duns): self
    {
        $this->duns = $duns;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setProfessional(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getProfessional() !== $this) {
            $user->setProfessional($this);
        }

        $this->user = $user;

        return $this;
    }
}
