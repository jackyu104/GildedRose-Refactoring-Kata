<?php

namespace GildedRose;

class BackstagePassesItem extends Item
{
    public function update(): void
    {
        $this->maintainQualityUltimateToFifty($this->maxRemainQuality());
        $this->decreaseSellInEveryDay();
        $this->isExpiredSellInToZeroQuality();
    }

    /**
     * 維持品質量最高到50
     * @param int $maxRemainQuality  最高維持品質量
     */
    private function maintainQualityUltimateToFifty(int $maxRemainQuality)
    {
        if ($this->quality >= $maxRemainQuality) {
            return;
        }

        $this->quality ++;

        if ($this->sell_in < 11) {
            $this->quality = $this->sell_in < 6 ? $this->quality + 2 :  $this->quality + 1;
        }

        $this->quality = $this->quality >= $maxRemainQuality ? $maxRemainQuality : $this->quality;
    }

    /**
     * 超過銷售期限，品質量歸0
     */
    private function isExpiredSellInToZeroQuality()
    {
        if ($this->isExpiredSellIn()) {
            $this->quality -= $this->quality;
        }
    }
}