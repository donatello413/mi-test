<?php

declare(strict_types=1);

namespace App\Transfers;

use Spatie\LaravelData\Data;

final class RequestDto extends Data
{
    public function __construct(
        public ?int $id,
    ) {
    }

    public static function fromArray(array $data): self
    {
        $validatedData = self::validate($data);

        return new self(
        );
    }
}
