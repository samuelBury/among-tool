<?php

namespace App\Entity;
use App\Entity\Client;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string")
     */
    private $codeDroitCommandeClient;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeDroitTest;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Profil;

    /**
     * @ORM\ManyToMany(targetEntity=Alarme::class, mappedBy="users")
     */
    private $alarmes;

    /**
     * @ORM\ManyToMany(targetEntity=Role::class, inversedBy="users")
     */
    private $Role;



    public function __construct()
    {
        $this->alarmes = new ArrayCollection();
        $this->Role = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getCodeDroitCommandeClient(): ?string
    {
        return $this->codeDroitCommandeClient;
    }

    public function setCodeDroitCommandeClient(string $codeDroitCommandeClient): self
    {
        $this->codeDroitCommandeClient = $codeDroitCommandeClient;

        return $this;
    }

    public function getCodeDroitTest(): ?string
    {
        return $this->codeDroitTest;
    }

    public function setCodeDroitTest(?string $codeDroitTest): self
    {
        $this->codeDroitTest = $codeDroitTest;

        return $this;
    }

    public function decriptionCodeTest(string $codeDroitTest): array
    {
        $arrayString = explode(",", $codeDroitTest);

        foreach ($arrayString as $unCode) {
            $arrayInt[] = (int)$unCode;
        }
        return $arrayInt;
    }

    public function controleCode(array $arrayInt): array
    {
        $colonne = ["x", "y", "z", "a"];
        $arrayDroit = array();
        $i = 0;
        foreach ($arrayInt as $int) {
            if (($int == 1) || ($int == 4) || ($int == 6) || ($int == 9)) {
                $arrayDroit[] = $colonne[$i] . "Read";
            }
            if (($int == 3) || ($int == 4) || ($int == 8) || ($int == 9)) {
                $arrayDroit[] = $colonne[$i] . "Write";
            }
            if (($int == 5) || ($int == 8) || ($int == 6) || ($int == 9)) {
                $arrayDroit[] = $colonne[$i] . "Edit";
            }
            $i++;
        }
        return $arrayDroit;
    }




    public function getProfil(): ?string
    {
        return $this->Profil;
    }

    public function setProfil(?string $Profil): self
    {
        $this->Profil = $Profil;

        return $this;
    }

    /**
     * @return Collection|Alarme[]
     */
    public function getAlarmes(): Collection
    {
        return $this->alarmes;
    }

    public function addAlarme(Alarme $alarme): self
    {
        if (!$this->alarmes->contains($alarme)) {
            $this->alarmes[] = $alarme;
            $alarme->addUser($this);
        }

        return $this;
    }

    public function removeAlarme(Alarme $alarme): self
    {
        if ($this->alarmes->removeElement($alarme)) {
            $alarme->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Role[]
     */
    public function getRole(): Collection
    {
        return $this->Role;
    }

    public function addRole(Role $role): self
    {
        if (!$this->Role->contains($role)) {
            $this->Role[] = $role;
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        $this->Role->removeElement($role);

        return $this;
    }






}
