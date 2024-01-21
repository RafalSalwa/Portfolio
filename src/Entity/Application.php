<?php

namespace App\Entity;

use App\Repository\AppsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore as SerializerIgnore;

#[ORM\Entity(repositoryClass: AppsRepository::class)]
class Application
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $img = null;

    #[SerializerIgnore]
    #[ORM\OneToMany(mappedBy: 'application', targetEntity: Tool::class)]
    private Collection $stackItem;

    #[SerializerIgnore]
    #[ORM\ManyToOne(inversedBy: 'applications')]
    private Stack $lang;

    public function __construct()
    {
        $this->stackItem = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
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

    public function getLang(): Stack
    {
        return $this->lang;
    }

    public function setLang(Stack $lang): static
    {
        $this->lang = $lang;

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

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): static
    {
        $this->img = $img;

        return $this;
    }

    /**
     * @return Collection<int, Tool>
     */
    public function getTechItem(): Collection
    {
        return $this->stackItem;
    }

    public function addTechItem(Tool $techItem): static
    {
        if (!$this->stackItem->contains($techItem)) {
            $this->stackItem->add($techItem);
            $techItem->setApplication($this);
        }

        return $this;
    }

    public function removeTechItem(Tool $techItem): static
    {
        if ($this->stackItem->removeElement($techItem)) {
            // set the owning side to null (unless already changed)
            if ($techItem->getApplication() === $this) {
                $techItem->setApplication(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
