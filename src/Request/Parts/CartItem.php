<?php

namespace ArvPayoneApi\Request\Parts;

class CartItem implements \JsonSerializable
{
    const TYPE_GOODS = 'goods';
    const TYPE_SHIPMENt = 'shipment';
    const TYPE_HANDLING = 'handling';
    /**
     * 0..n
     *
     * @var int
     */
    private $position;

    /**
     * Product number, order number, etc.
     * Permitted symbols: 0-9 a-z A-Z ()[]{} +-_#/:
     *
     * @var string
     */
    private $id;

    /**
     * Item type: goods|shipment|handling
     *
     * @var string
     */
    private $it;

    /**
     * Quantity
     *
     * @var int
     */
    private $no;

    /**
     * Unit price
     * (in smallest currency unit! e.g. cent)
     *
     * @var int
     */
    private $pr;

    /**
     * Description (on invoice)
     * For PPE maximum 127 characters are processed.
     *
     * @var string
     */
    private $de;

    /**
     * VAT rate (% or bp)
     * value < 100 = percent
     * value > 99 = basis points (e.g. 1900 = 19%)
     *
     * @var int
     */
    private $va;

    /**
     * CartItem constructor.
     *
     * @param int $position
     * @param string $sku
     * @param string $type
     * @param int $qty
     * @param int $price in cent
     * @param string $description =''
     * @param int $taxRate
     */
    public function __construct(
        $position,
        $sku,
        $type,
        $qty,
        $price,
        $taxRate,
        $description = ''
    ) {
        $this->position = $position;
        $this->id = $sku;
        $this->it = $type;
        $this->no = $qty;
        $this->pr = $price;
        $this->de = $description;
        $this->va = $taxRate;
    }

    /**
     * Getter for Position
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Getter for Id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Getter for It
     *
     * @return string
     */
    public function getIt()
    {
        return $this->it;
    }

    /**
     * Getter for No
     *
     * @return int
     */
    public function getNo()
    {
        return $this->no;
    }

    /**
     * Getter for Pr
     *
     * @return int
     */
    public function getPr()
    {
        return $this->pr;
    }

    /**
     * Getter for De
     *
     * @return string
     */
    public function getDe()
    {
        return $this->de;
    }

    /**
     * Getter for Va
     *
     * @return int
     */
    public function getVa()
    {
        return $this->va;
    }

    public function jsonSerialize()
    {
        return [
            'id' . $this->getPosition() => $this->getId(),
            'it' . $this->getPosition() => $this->getIt(),
            'no' . $this->getPosition() => $this->getNo(),
            'pr' . $this->getPosition() => $this->getPr(),
            'de' . $this->getPosition() => $this->getDe(),
            'va' . $this->getPosition() => $this->getva(),
        ];
    }
}
