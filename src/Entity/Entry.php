<?php

namespace App\Entity;

use App\Repository\EntryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntryRepository::class)]
class Entry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $word = null;

    #[ORM\Column(length: 20)]
    private ?string $wordtype = null;

    #[ORM\Column(length: 255)]
    private ?string $definition = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWord(): ?string
    {
        return $this->word;
    }

    public function setWord(string $word): static
    {
        $this->word = $word;

        return $this;
    }

    public function getWordtype(): ?string
    {
        return $this->wordtype;
    }

    public function setWordtype(string $wordtype): static
    {
        $this->wordtype = $wordtype;

        return $this;
    }

    public function getDefinition(): ?string
    {
        return $this->definition;
    }

    public function setDefinition(string $definition): static
    {
        $this->definition = $definition;

        return $this;
    }
}
