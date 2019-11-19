<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 * @ORM\Entity
 * @ORM\Table(name="cblog_page",
 * 	uniqueConstraints={
 *	 @ORM\UniqueConstraint(name="UC_PAGE_URL",columns={"url"})
 *	},
 *	indexes={
	 @ORM\Index(name="IDX_PAGE_URL", columns={"url"})
 *	}
 * )
 */
class PageEntity extends ContentEntity
{	

}
