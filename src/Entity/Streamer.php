<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StreamerRepository")
 */
class Streamer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nickname;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $fotos = [];

    /**
     * @ORM\OneToMany(targetEntity="News", mappedBy="streamer")
     */
    private $news;

    public function __construct()
    {
        $this->news = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getFotos(): ?array
    {
        return $this->fotos;
    }

    public function setFotos(?array $fotos): self
    {
        $this->fotos = $fotos;

        return $this;
    }

    public function getNews(): ?ArrayCollection
    {
        return $this->news;
    }

    public function setNews(?ArrayCollection $news): self
    {
        $this->news = $news;

        return $this;
    }
}
