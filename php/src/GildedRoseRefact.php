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

            if ($item->name == 'Aged Brie' || $item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                $item->quality = $item->quality < 50 ? $item->quality + 1 : $item->quality;
                if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                    if ($item->sell_in < 11 && $item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                    if ($item->sell_in < 6 && $item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                }
            } else if ($item->quality > 0 && $item->name != 'Sulfuras, Hand of Ragnaros') {
                $item->quality = $item->quality - 1;
            }

            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                $item->sell_in = $item->sell_in - 1;
            }

            if ($item->sell_in >= 0) {
                continue;
            }

            if (!in_array($item->name, ['Aged Brie', 'Backstage passes to a TAFKAL80ETC concert'])) {
                $item->quality = $item->name != 'Sulfuras, Hand of Ragnaros' && $item->quality > 0
                    ? $item->quality = $item->quality - 1
                    : $item->quality;
            }

            if ($item->name == 'Aged Brie' && $item->quality < 50) {
                $item->quality = $item->quality + 1;
            }

            if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                $item->quality = $item->quality - $item->quality;
            }
        }
    }
}