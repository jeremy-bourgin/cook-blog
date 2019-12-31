<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * ContactEntity
 */
class ContactEntity
{
    /**
     * @var string
     * 
     * @Assert\NotBlank
     * @Assert\Email
    */
    private $from;

    /**
     * @var string
     * 
     * @Assert\NotBlank
     * @Assert\Length(max=100)
    */
    private $object;

    /**
     * @var string
     * 
     * @Assert\NotBlank
    */
    private $message;
    
	public function getFrom(): ?string
	{
		return $this->from;
	}

	public function getObject(): ?string
	{
		return $this->object;
	}

	public function getMessage(): ?string
	{
		return $this->message;
	}

	public function setFrom($from): self
	{
		$this->from = $from;
		
		return $this;
	}

	public function setObject($object): self
	{
		$this->object = $object;
		
		return $this;
	}

	public function setMessage($message): self
	{
		$this->message = $message;
		
		return $this;
	}
}
