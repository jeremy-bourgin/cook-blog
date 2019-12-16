<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PageEntity
 *
 * @ORM\Entity
 * @ORM\Table(name="cblog_page",
 *	indexes={
	 @ORM\Index(name="IDX_PAGE_URL", columns={"url"})
 *	}
 * )
 */
class PageEntity extends ContentEntity
{	

}
