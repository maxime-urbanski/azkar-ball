<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
#[ApiResource]
class Player
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(UuidGenerator::class)]
    private string $id;

    #[ORM\Column(type: 'string', length: 100, unique: true)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'organized_by', targetEntity: MatchGame::class)]
    private $matchGames;

    #[ORM\ManyToMany(targetEntity: Team::class, mappedBy: 'player_id')]
    private $teams;

    public function __construct()
    {
        $this->matchGames = new ArrayCollection();
        $this->teams = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, MatchGame>
     */
    public function getMatchGames(): Collection
    {
        return $this->matchGames;
    }

    public function addMatchGame(MatchGame $matchGame): self
    {
        if (!$this->matchGames->contains($matchGame)) {
            $this->matchGames[] = $matchGame;
            $matchGame->setOrganizedBy($this);
        }

        return $this;
    }

    public function removeMatchGame(MatchGame $matchGame): self
    {
        if ($this->matchGames->removeElement($matchGame)) {
            // set the owning side to null (unless already changed)
            if ($matchGame->getOrganizedBy() === $this) {
                $matchGame->setOrganizedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
            $team->addPlayerId($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->removeElement($team)) {
            $team->removePlayerId($this);
        }

        return $this;
    }
}
