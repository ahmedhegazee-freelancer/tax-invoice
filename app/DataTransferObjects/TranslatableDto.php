<?php

namespace App\DataTransferObjects;

class TranslatableDto
{

    private function __construct(
        private int $translatableId,
        private string $translatableClass,
    ) {
    }
    public static function create(
        int $translatableId,
        string $translatableClass,
    ) {
        return new self($translatableId, $translatableClass);
    }
    public function toArray()
    {
        return [
            'translatable_id' => $this->translatableId,
            'translatable_type' => $this->translatableClass,
        ];
    }
}