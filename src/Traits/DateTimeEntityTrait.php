<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;

trait DateTimeEntityTrait
{
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt = null): static
    {
        $tmz = new \DateTimeZone("America/Sao_Paulo");
        $this->createdAt = $createdAt ?? new \DateTimeImmutable("now", $tmz);

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt = null): static
    {
        $tmz = new \DateTimeZone("America/Sao_Paulo");

        $this->updatedAt = $updatedAt ?? new \DateTimeImmutable("now", $tmz);

        return $this;
    }
}
