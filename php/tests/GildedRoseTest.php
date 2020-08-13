<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\AgedBrieItem;
use GildedRose\BackstagePassesItem;
use GildedRose\OtherItem;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testFoo(): void
    {
        $items = [new OtherItem('foo', 0, 0)];
        $gildedRoseRefact = new GildedRose($items);
        $gildedRoseRefact->updateQuality();
        $this->assertSame('foo', $items[0]->name);
    }

    public function testDecreaseOneQualityForEveryDay(): void
    {
        $items = [new OtherItem('+5 Dexterity Vest', 1, 1)];
        $dexterityVest = new GildedRose($items);
        $dexterityVest->updateQuality();
        $this->assertEquals(0, $items[0]->quality);
    }

    public function testDecreaseDoubleQualityForEveryDay(): void
    {
        $items = [new OtherItem('+5 Dexterity Vest', 0, 2)];
        $dexterityVest = new GildedRose($items);
        $dexterityVest->updateQuality();
        $this->assertEquals(0, $items[0]->quality);
    }

    public function testQualityNeverNegative()
    {
        $items = [new OtherItem('Elixir of the Mongoose', -1, 0)];
        $elixirOfTheMongose = new GildedRose($items);
        $elixirOfTheMongose->updateQuality();
        $this->assertEquals(0, $items[0]->quality);
    }

    public function testQualityNeverHigherThenFifty()
    {
        $items = [new AgedBrieItem('Aged Brie', 1, 49)];
        $elixirOfTheMongose = new GildedRose($items);
        $elixirOfTheMongose->updateQuality();
        $this->assertEquals(50, $items[0]->quality);
    }

    public function testQualityToZeroWhenExpiredSellIn()
    {
        $items = [new BackstagePassesItem('Backstage passes to a TAFKAL80ETC concert', 0, 80)];
        $elixirOfTheMongose = new GildedRose($items);
        $elixirOfTheMongose->updateQuality();
        $this->assertEquals(0, $items[0]->quality);
    }
}
