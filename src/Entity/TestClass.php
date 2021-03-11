<?php

namespace App\Entity;

use App\Repository\TestClassRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TestClassRepository::class)
 */
class TestClass
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $x;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $y;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $z;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $a;
    public function trouverChampApplication(string $champ){
        if($champ=='a'){
            return $this->getA();
        }
        if($champ=='x'){
            return $this->getX();
        }
        if($champ=='a'){
            return $this->getY();
        }
        if($champ=='a'){
            return $this->getZ();
        }

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getX(): ?string
    {
        return $this->x;
    }

    public function setX(string $x): self
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): ?int
    {
        return $this->y;
    }

    public function setY(?int $y): self
    {
        $this->y = $y;

        return $this;
    }

    public function getZ(): ?string
    {
        return $this->z;
    }

    public function setZ(string $z): self
    {
        $this->z = $z;

        return $this;
    }

    public function getA(): ?DateTimeInterface
    {
        return $this->a;
    }

    public function setA(DateTimeInterface $a): self
    {
        $this->a = $a;

        return $this;
    }
}
