<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Transfers\BusinessDto;

interface BusinessRepositoryInterface
{
    /**
     * @param string $slug
     * @return BusinessDto
     */
    public function getBusinessBySlug(string $slug): BusinessDto;
}