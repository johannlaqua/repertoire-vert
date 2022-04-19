<?php

/* -- !!!!! CETTE CLASSE CORRESPOND AUX PRODUITS ET LA CLASSE !!!!! -- */
/* -- !!!!! "Product" EST LA SUPERCLASSE DES PRODUITS ET DES !!!!! -- */
/* -- !!!!! SERVICES   ET DES MARCHANDISES                   !!!!! --*/

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Marchandise
 *
 * @ORM\Table(name="marchandise")
 * @ORM\Entity(repositoryClass="App\Repository\MarchandiseRepository")
 */
class Marchandise extends Product
{

    /**
     * @var string
     *
     * @ORM\Column(name="packaging", type="string",length=255, nullable=true)
     */
    protected $packaging; //marchandise

    /**
     * @var string
     *
     * @ORM\Column(name="quantity", type="integer",nullable=true)
     */
    protected $quantity; //marchandise

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="integer",nullable=true)
     */
    protected $weight; //marchandise

    /**
     * @var string
     *
     * @ORM\Column(name="weightunit", type="string",length=255, nullable=true)
     */
    protected $weightunit; //marchandise

    /**
     * @var string
     *
     * @ORM\Column(name="volume", type="integer",nullable=true)
     */
    protected $volume; //marchandise

    /**
     * @var string
     *
     * @ORM\Column(name="volumeunit", type="string",length=255, nullable=true)
     */
    protected $volumeunit; //marchandise

    /**
     * @var string
     *
     * @ORM\Column(name="height", type="integer",nullable=true)
     */
    protected $height; //marchandise

    /**
     * @var string
     *
     * @ORM\Column(name="width", type="integer",nullable=true)
     */
    protected $width; //marchandise

    /**
     * @var string
     *
     * @ORM\Column(name="depth", type="integer",nullable=true)
     */
    protected $depth; //marchandise

    /**
     * @var string
     *
     * @ORM\Column(name="lengthunit", type="string",length=255, nullable=true)
     */
    protected $lengthunit;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $sellType; //marchandise

    /**
     * @return string
     */
    public function getPackaging()
    {
        return $this->packaging;
    }

    /**
     * @param string $packaging
     */
    public function setPackaging($packaging)
    {
        $this->packaging = $packaging;
    }

    /**
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param string $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param string $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return string
     */
    public function getWeightUnit()
    {
        return $this->weightunit;
    }

    /**
     * @param string $weightunit
     */
    public function setWeightUnit($weightunit)
    {
        $this->weightunit = $weightunit;
    }

    /**
     * @return string
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param string $volume
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    /**
     * @return string
     */
    public function getVolumeUnit()
    {
        return $this->volumeunit;
    }

    /**
     * @param string $volumeunit
     */
    public function setVolumeUnit($volumeunit)
    {
        $this->volumeunit = $volumeunit;
    }

    /**
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param string $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param string $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return string
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @param string $depth
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
    }

    /**
     * @return string
     */
    public function getLengthUnit()
    {
        return $this->lengthunit;
    }

    /**
     * @param string $lengthunit
     */
    public function setLengthUnit($lengthunit)
    {
        $this->lengthunit = $lengthunit;
    }

    public function getSellType(): ?string
    {
        return $this->sellType;
    }

    public function setSellType(?string $sellType): self
    {
        $this->sellType = $sellType;

        return $this;
    }
}
