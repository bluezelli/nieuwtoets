<?php

namespace App\Entity;

use App\Repository\ContinentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContinentRepository::class)]
class Continent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'continent', targetEntity: Country::class)]
    private Collection $country;

    public function __construct()
    {
        $this->country = new ArrayCollection();
    }

    public function getId(): ?int
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
     * @return Collection<int, Country>
     */
    public function getCountry(): Collection
    {
        return $this->country;
    }

    public function addCountry(Country $country): self
    {
        if (!$this->country->contains($country)) {
            $this->country->add($country);
            $country->setContinent($this);
        }

        return $this;
    }

    public function removeCountry(Country $country): self
    {
        if ($this->country->removeElement($country)) {
            // set the owning side to null (unless already changed)
            if ($country->getContinent() === $this) {
                $country->setContinent(null);
            }
        }

        return $this;
    }
}
