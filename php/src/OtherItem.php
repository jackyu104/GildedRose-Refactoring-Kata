<?php

namespace GildedRose;

class OtherItem extends Item
{
    public function update(): void
    {
        if ($this->name == 'Sulfuras, Hand of Ragnaros') {
            return;
        }

        $this->decreaseSellInEveryDay();
        $this->decreaseQualityEveryDayUltimateToZero($this->bottomQuality());
    }

    /**
     * 每天折舊品質量，過銷售期限加倍，最低到0
     * @param $bottomQuality
     */
    private function decreaseQualityEveryDayUltimateToZero($bottomQuality)
    {
        if ($this->quality <= $bottomQuality) {
            return;
        }

        $this->quality = $this->isExpiredSellIn() ? $this->quality - 2: $this->quality - 1;
        $this->quality = $this->quality <= $bottomQuality ? $bottomQuality : $this->quality;
    }
}