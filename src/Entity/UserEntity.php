<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(
 * 	name="cblog_user",
 * 	uniqueConstraints={
 *	 @ORM\UniqueConstraint(name="UC_USER_EMAIL",columns={"email"}),
 *	 @ORM\UniqueConstraint(name="UC_USER_USERNAME", columns={"username"}),
 *	 @ORM\UniqueConstraint(name="UC_USER_PASSWORD", columns={"password"})
 *	},
 * 	indexes={
 *	 @ORM\Index(name="IDX_USER_USERNAME", columns={"username"})
 *	}
 * )
 * @ORM\Entity
 */

class UserEntity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
	private $id;
	
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=320, nullable=false)
     */
	private $email;
	
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=20, nullable=false)
     */
	private $username;
	
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=60, nullable=false)
     */
	private $password;

    public function getId(): ?string
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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
	
	
}
