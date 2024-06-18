<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use App\Traits\DateTimeEntityTrait;
use DateTimeImmutable;
use DateTimeZone;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\Table(name: 'categories')]
class Category
{
    use DateTimeEntityTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;


    /**
     * @var Collection<int, Adsense>
     */
    #[ORM\ManyToMany(targetEntity: Adsense::class, mappedBy: 'categories')]
    private Collection $adsenses;

    public function __construct()
    {
        $this->adsenses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Adsense>
     */
    public function getAdsenses(): Collection
    {
        return $this->adsenses;
    }

    public function addAdsense(Adsense $adsense): static
    {
        if (!$this->adsenses->contains($adsense)) {
            $this->adsenses->add($adsense);
            $adsense->addCategory($this);
        }

        return $this;
    }

    public function removeAdsense(Adsense $adsense): static
    {
        if ($this->adsenses->removeElement($adsense)) {
            $adsense->removeCategory($this);
        }

        return $this;
    }
}
