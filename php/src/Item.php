<?php

declare(strict_types=1);

namespace GildedRose;

abstract class Item
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $sell_in;

    /**
     * @var int
     */
    protected $quality;

    public function __construct(string $name, int $sell_in, int $quality)
    {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString(): string
    {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }


    public function __get($name)
    {
        return $this->$name;
    }

    abstract public function update(): void;

    /**
     * 每天遞減銷售期限
     * @return int
     */
    protected function decreaseSellInEveryDay()
    {
        $this->sell_in --;
    }

    /**
     * 已過銷售期限
     * @return bool
     */
    protected function isExpiredSellIn(): bool
    {
        return $this->sell_in < 0;
    }

    /**
     * 最大保質量
     * @return int
     */
    protected function maxRemainQuality(): int
    {
        return 50;
    }

    /**
     * 最低品質量
     * @return int
     */
    protected function bottomQuality(): int
    {
        return 0;
    }
}
