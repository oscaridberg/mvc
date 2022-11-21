<?php

namespace App\Card;

class Card
{
    protected int $value;
    protected string $color;

    public function __construct(int $value = 1, string $color = "heart")
    {
        $this->value = $value;
        $this->color = $color;
    }

    public function getCard(): string
    {
        return "{$this->color} {$this->value}";
    }

    public function getCardGraphic(): string
    {
        $graphic = array(
            'heart' => '♥',
            'diamond' => '♦',
            'clover' => '♣',
            'spade' => '♠',
            'joker' => '🃏'
        );

        return $graphic[$this->color];
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getStringValue(): string
    {
        $cardStrings = array(
            1 => 'A',
            11 => 'J',
            12 => 'Q',
            13 => 'K',
            14 => 'A'
        );

        if ($this->value <= 1 or $this->value >= 11) {
            return $cardStrings[$this->value];
        };


        return strval($this->value);
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setValue(int $number): void
    {
        $this->value = $number;
    }

    public function isAce(): bool
    {
        return $this->getStringValue() === 'A';
    }
}