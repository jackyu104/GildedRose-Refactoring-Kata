<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRoseRefact
{
    /**
     * @var Item[]
     */
    public $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            switch ($item->name) {
                case 'Aged Brie':
                    $this->agedBrieUpdateQuality($item);
                    break;
                case 'Backstage passes to a TAFKAL80ETC concert':
                    $this->backstagePassesUpdateQuality($item);
                    break;
                case 'Sulfuras, Hand of Ragnaros':
                    $this->sulfurasUpdateQuality($item);
                    break;
                default:
                    $this->otherUpdateQuality($item);
            }
        }
    }

    private function agedBrieUpdateQuality(Item $item)
    {
        $item->quality = $item->quality < 50 ? $item->quality + 1 : $item->quality;
        $item->sell_in -= 1;
        $item->quality = $item->quality < 50 && $item->sell_in < 0 ? $item->quality + 1 : $item->quality;

        return $item;
    }

    private function backstagePassesUpdateQuality(Item $item)
    {
        $item->quality = $item->quality < 50 ? $item->quality + 1 : $item->quality;
        $item->quality = $item->quality < 50 && $item->sell_in < 11 ? $item->quality + 1 : $item->quality;
        $item->quality = $item->quality < 50 && $item->sell_in < 6 ? $item->quality + 1 : $item->quality;
        $item->sell_in -= 1;
        $item->quality = $item->sell_in < 0 ? $item->quality - $item->quality : $item->quality;

        return $item;
    }

    private function sulfurasUpdateQuality(Item $item)
    {
        return $item;
    }

    private function otherUpdateQuality(Item $item)
    {
        $item->quality = $item->quality > 0 ? $item->quality - 1 : $item->quality;
        $item->sell_in -= 1;
        $item->quality = $item->sell_in < 0 &&  $item->quality > 0 ? $item->quality - 1 : $item->quality;

        return $item;
    }
}