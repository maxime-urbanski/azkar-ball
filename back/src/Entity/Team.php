<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
#[ApiResource]
class Team
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class:UuidGenerator::class)]
    private string $id;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'team_home', targetEntity: MatchGame::class)]
    private $matchGames;

    #[ORM\ManyToMany(targetEntity: Player::class, inversedBy: 'teams')]
    private $player_id;

    public function __construct()
    {
        $this->matchGames = new ArrayCollection();
        $this->player_id = new ArrayCollection();
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
            $matchGame->setTeamHome($this);
        }

        return $this;
    }

    public function removeMatchGame(MatchGame $matchGame): self
    {
        if ($this->matchGames->removeElement($matchGame)) {
            // set the owning side to null (unless already changed)
            if ($matchGame->getTeamHome() === $this) {
                $matchGame->setTeamHome(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Player>
     */
    public function getPlayerId(): Collection
    {
        return $this->player_id;
    }

    public function addPlayerId(Player $playerId): self
    {
        if (!$this->player_id->contains($playerId)) {
            $this->player_id[] = $playerId;
        }

        return $this;
    }

    public function removePlayerId(Player $playerId): self
    {
        $this->player_id->removeElement($playerId);

        return $this;
    }
}
