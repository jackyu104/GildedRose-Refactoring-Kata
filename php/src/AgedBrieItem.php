<?php

namespace GildedRose;

class AgedBrieItem extends Item
{
    public function update(): void
    {
        $this->decreaseSellInEveryDay();
        $this->maintainQualityUltimateToFifty($this->maxRemainQuality());
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

        $this->quality = $this->isExpiredSellIn() ?  $this->quality + 2 : $this->quality + 1;
        $this->quality = $this->quality >= $maxRemainQuality ? $maxRemainQuality : $this->quality;
    }
}