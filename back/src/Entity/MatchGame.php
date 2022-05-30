<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MatchGameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchGameRepository::class)]
#[ApiResource]
class MatchGame
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date', nullable: true)]
    private $date;

    #[ORM\ManyToOne(targetEntity: Player::class, inversedBy: 'matchGames')]
    private $organized_by;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $score_home;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $score_away;

    #[ORM\ManyToOne(targetEntity: Team::class, inversedBy: 'matchGames')]
    private $team_home;

    #[ORM\ManyToOne(targetEntity: Team::class, inversedBy: 'matchGames')]
    private $team_away;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getOrganizedBy(): ?Player
    {
        return $this->organized_by;
    }

    public function setOrganizedBy(?Player $organized_by): self
    {
        $this->organized_by = $organized_by;

        return $this;
    }

    public function getScoreHome(): ?int
    {
        return $this->score_home;
    }

    public function setScoreHome(?int $score_home): self
    {
        $this->score_home = $score_home;

        return $this;
    }

    public function getScoreAway(): ?int
    {
        return $this->score_away;
    }

    public function setScoreAway(?int $score_away): self
    {
        $this->score_away = $score_away;

        return $this;
    }

    public function getTeamHome(): ?Team
    {
        return $this->teame_home;
    }

    public function setTeamHome(?Team $team_home): self
    {
        $this->teame_home = $team_home;

        return $this;
    }

    public function getTeamAway(): ?Team
    {
        return $this->team_away;
    }

    public function setTeamAway(?Team $team_away): self
    {
        $this->team_away = $team_away;

        return $this;
    }
}
