<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * UserEntity
 *
 * @ORM\Table(
 * 	name="cblog_user",
 * 	uniqueConstraints={
 *	 @ORM\UniqueConstraint(name="UC_USER_USERNAME", columns={"username"}),
 *	 @ORM\UniqueConstraint(name="UC_USER_EMAIL",columns={"email"}),
 *	 @ORM\UniqueConstraint(name="UC_USER_PASSWORD", columns={"password"})
 *	},
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
}
