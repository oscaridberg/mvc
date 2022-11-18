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
        switch ($this->value) {
            case 1:
            case 14:
                return 'A';
                break;
            case 11:
                return 'J';
                break;
            case 12:
                return 'Q';
                break;
            case 13:
                return 'K';
                break;
            default:
                return strval($this->value);
                break;
        }
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
