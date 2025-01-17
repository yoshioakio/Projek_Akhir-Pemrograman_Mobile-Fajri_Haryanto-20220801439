<?php

namespace App\Filament\Admin\Resources\CompanyResource\Api;

use App\Filament\Admin\Resources\CompanyResource;
use Rupadana\ApiService\ApiService;

class CompanyApiService extends ApiService
{
    protected static ?string $resource = CompanyResource::class;

    public static function handlers(): array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class,
        ];

    }
}
