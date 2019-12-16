<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * UserEntity
 *
 * @ORM\Table(
 * 	name="cblog_user",
 * 	indexes={
 *	 @ORM\Index(name="IDX_USER_USERNAME", columns={"username"})
 *	}
 * )
 * @ORM\Entity
 */

class UserEntity extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
	protected $id;
	
	public function __construct()
   	{
   		parent::__construct();
   		
   	}

    public function getId(): ?string
    {
        return $this->id;
    }
}
