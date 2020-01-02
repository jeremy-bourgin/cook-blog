<?php
namespace App\Entity;

use App\Exception\Config\InvalidConfigException;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ConfigEntity
 *
 * @ORM\Entity
 * @ORM\Table(name="cblog_config")
 * @UniqueEntity(
 *  fields="name",
 *  message="unique_name"
 * )
 */
class ConfigEntity
{
    const BOOL_TYPE = 0;
    const INT_TYPE = 1;
    const STRING_TYPE = 2;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false, unique=true)
	 * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
	private $name;
	
    /**
     * @var string
     *
     * @ORM\Column(name="raw_value", type="text", nullable=false)
     */
    private $raw_value;
	
    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", length=255, nullable=false)
     */
	private $full_name;
	    
    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", nullable=false, options={"default" : 2})
     * @Assert\LessThanOrEqual(2)
     */
    private $type = 2;

    public static function stringToType(string $type_name): int
    {
        switch($type_name)
        {
            case "bool":
                $r = self::BOOL_TYPE;
            break;

            case "int":
                $r = self::INT_TYPE;
            break;

            case "string":
                $r = self::STRING_TYPE;
            break;

            default:
                $r = self::STRING_TYPE;
            break;
        }

        return $r;
    }

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->type = self::STRING_TYPE;
    }

    public function getInputType(): string
    {
        switch($this->type)
        {
            case self::BOOL_TYPE:
                $r = ChoiceType::class;
            break;

            case self::INT_TYPE:
                $r = IntegerType::class;
            break;

            case self::STRING_TYPE:
                $r = TextType::class;
            break;

            default:
                $r = TextType::class;
            break;
        }

        return $r;
    }

    public function getValue()
    {
        $r = $this->raw_value;

        switch($this->type)
        {
            case self::BOOL_TYPE:
                $r = boolval($r);
            break;

            case self::INT_TYPE:
                $r = (int) $r;
            break;

            case self::STRING_TYPE:
                // it is already string
            break;
        }

        return $r;
    }

    public function setValue(string $raw_value): self
    {
        if ($this->type === self::BOOL_TYPE && $raw_value !== "0" && $raw_value !== "1")
        {
            throw new InvalidConfigException($this->name);
        }
        else if ($this->type === self::INT_TYPE && !is_numeric($raw_value))
        {
            throw new InvalidConfigException($this->name);
        }

        return $this->setRawValue($raw_value);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getRawValue(): ?string
    {
        return $this->raw_value;
    }

    public function setRawValue(string $raw_value): self
    {
        $this->raw_value = $raw_value;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    public function setFullName(string $full_name): self
    {
        $this->full_name = $full_name;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }


}
