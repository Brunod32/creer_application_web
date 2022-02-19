<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: MissionRepository::class)]
class Mission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 30)]
    private string $title;

    #[ORM\Column(type: 'string', length: 255)]
    private string $description;

    #[ORM\Column(type: 'string', length: 15)]
    private string $code;

    #[ORM\Column(type: 'string', length: 30)]
    private string $country;

    #[ORM\Column(type: 'string', length: 20)]
    private string $type;

    #[ORM\Column(type: 'string', length: 20)]
    private string $status;

    #[ORM\Column(type: 'date')]
    private DateTime $dateStart;

    #[ORM\Column(type: 'date')]
    private DateTime $dateEnd;

    #[ORM\ManyToMany(targetEntity: Agent::class, inversedBy: 'missions')]
    private $agent;

    #[ORM\OneToMany(mappedBy: 'mission', targetEntity: Contact::class)]
    private $contact;

    #[ORM\OneToMany(mappedBy: 'mission', targetEntity: Target::class, orphanRemoval: true)]
    private $target;

    #[ORM\OneToMany(mappedBy: 'mission', targetEntity: Hideout::class)]
    private $hideout;

    #[ORM\ManyToOne(targetEntity: Speciality::class, inversedBy: 'missions')]
    #[ORM\JoinColumn(nullable: false)]
    private Speciality $speciality;

    #[Pure] public function __construct()
    {
        $this->agent = new ArrayCollection();
        $this->contact = new ArrayCollection();
        $this->target = new ArrayCollection();
        $this->hideout = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * @return Collection|Agent[]
     */
    public function getAgent(): Collection|array
    {
        return $this->agent;
    }

    public function addAgent(Agent $agent): self
    {
        if (!$this->agent->contains($agent)) {
            $this->agent[] = $agent;
        }

        return $this;
    }

    public function removeAgent(Agent $agent): self
    {
        $this->agent->removeElement($agent);

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContact(): array|Collection
    {
        return $this->contact;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contact->contains($contact)) {
            $this->contact[] = $contact;
            $contact->setMission($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contact->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getMission() === $this) {
                $contact->setMission(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Target[]
     */
    public function getTarget(): array|Collection
    {
        return $this->target;
    }

    public function addTarget(Target $target): self
    {
        if (!$this->target->contains($target)) {
            $this->target[] = $target;
            $target->setMission($this);
        }

        return $this;
    }

    public function removeTarget(Target $target): self
    {
        if ($this->target->removeElement($target)) {
            // set the owning side to null (unless already changed)
            if ($target->getMission() === $this) {
                $target->setMission(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Hideout[]
     */
    public function getHideout(): Collection|array
    {
        return $this->hideout;
    }

    public function addHideout(Hideout $hideout): self
    {
        if (!$this->hideout->contains($hideout)) {
            $this->hideout[] = $hideout;
            $hideout->setMission($this);
        }

        return $this;
    }

    public function removeHideout(Hideout $hideout): self
    {
        if ($this->hideout->removeElement($hideout)) {
            // set the owning side to null (unless already changed)
            if ($hideout->getMission() === $this) {
                $hideout->setMission(null);
            }
        }

        return $this;
    }

    public function getSpeciality(): Speciality
    {
        return $this->speciality;
    }

    public function setSpeciality(Speciality $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    // Add this function to string the mission name in the agent form
    public function __toString(): string
    {
        return $this->title;
    }


    // Mission constraints
    // For a mission, Contact must have the nationality of the country's mission
    public function contactIsValid(): bool
    {
        $dataContact = $this->contact;
        $dataCountry = $this->country;

        foreach ($dataContact as $contact) {
            if ($dataCountry != $contact->getNationality()) {
                return false;
            }
        }
        return true;
    }

    // For a mission, less than one agent should have the same speciality than the mission required one
    public function agentSpecialityIsValid(): bool
    {
        $dataAgent = $this->agent;
        $dataSpeciality = $this->speciality;
        $AgentSpeciality = [];

        foreach ($dataAgent as $agent) {
            $agentSpeciality = $agent->displaySpecialities();
            if (in_array($dataSpeciality->getName(), $agentSpeciality)) {
                return true;
            }
        }
        return false;
    }

    // For a mission, Target and Agent can't have same nationality
    public function agentNationalityIsValid(): bool
    {
        $dataAgent = $this->agent;
        $dataTarget = $this->target;

        foreach ($dataAgent as $agent) {
            foreach ($dataTarget as $target) {
                if ($agent->getNationality() == $target->getNationality()) {
                    return false;
                }
            }
        }
        return true;
    }

    // For a mission, Hideout must locate in the country's mission
    public function hideoutIsValid(): bool
    {
        $dataHideout = $this->hideout;
        $dataCountry = $this->country;

        foreach ($dataHideout as $hideout) {
            if ($hideout->getCountry() != $dataCountry) {
                return false;
            }
        }
        return true;
    }

    // Validate conditions
    public function missionIsValid(): bool
    {
        if (
            !$this->contactIsValid() ||
            !$this->agentSpecialityIsValid() ||
            !$this->agentNationalityIsValid() ||
            !$this->hideoutIsValid()
        ) {
            return false;
        }
        return true;
    }

}
