<?php

declare(strict_types = 1);

namespace src\Shared\Infrastructure;

use src\Shared\Domain\SlugGenerator;
use Cviebrock\EloquentSluggable\Services\SlugService;

final class CviebrockEloquentSluggable implements SlugGenerator
{
    
    public function generate($eloquentModel,  $stringToConvert): string
    {
        $slug = SlugService::createSlug($eloquentModel, 'slug', $stringToConvert);

        return $slug;
    }
}
