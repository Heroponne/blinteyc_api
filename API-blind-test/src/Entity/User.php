<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $totalScore;

    /**
     * @ORM\OneToMany(targetEntity=Participation::class, mappedBy="player", orphanRemoval=true)
     */
    private $participations;

    /**
     * @ORM\Column(type="binary", nullable=true)
     */
    private $sessionHash;

    public function __construct()
    {
        $this->participations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getTotalScore(): ?int
    {
        return $this->totalScore;
    }

    public function setTotalScore(?int $totalScore): self
    {
        $this->totalScore = $totalScore;

        return $this;
    }

    /**
     * @return Collection|Participation[]
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Participation $participation): self
    {
        if (!$this->participations->contains($participation)) {
            $this->participations[] = $participation;
            $participation->setPlayer($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): self
    {
        if ($this->participations->removeElement($participation)) {
            // set the owning side to null (unless already changed)
            if ($participation->getPlayer() === $this) {
                $participation->setPlayer(null);
            }
        }

        return $this;
    }

    public function getSessionHash()
    {
        return $this->sessionHash;
    }

    public function setSessionHash($sessionHash): self
    {
        $this->sessionHash = $sessionHash;

        return $this;
    }

}
