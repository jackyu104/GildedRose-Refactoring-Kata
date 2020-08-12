<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\GildedRoseRefact;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testFoo(): void
    {
        $items = [new Item('foo', 0, 0)];
        $gildedRoseRefact = new GildedRoseRefact($items);
        $gildedRoseRefact->updateQuality();
        $this->assertSame('foo', $items[0]->name);
    }

    public function testDexterityVestDecreaseOneQuality(): void
    {
        $items = [new Item('+5 Dexterity Vest', 1, 1)];
        $dexterityVest = new GildedRoseRefact($items);
        $dexterityVest->updateQuality();
        $this->assertEquals(0, $items[0]->quality);
    }

    public function testDexterityVestDecreaseDoubleQuality(): void
    {
        $items = [new Item('+5 Dexterity Vest', 0, 2)];
        $dexterityVest = new GildedRoseRefact($items);
        $dexterityVest->updateQuality();
        $this->assertEquals(0, $items[0]->quality);
    }

    public function testQualityNeverNegative()
    {
        $items = [new Item('Elixir of the Mongoose', -1, 0)];
        $elixirOfTheMongose = new GildedRoseRefact($items);
        $elixirOfTheMongose->updateQuality();
        $this->assertEquals(0, $items[0]->quality);
    }
}
