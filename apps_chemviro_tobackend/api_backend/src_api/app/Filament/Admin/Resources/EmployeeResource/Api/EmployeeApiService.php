<?php

namespace App\Filament\Admin\Resources\EmployeeResource\Api;

use App\Filament\Admin\Resources\EmployeeResource;
use Rupadana\ApiService\ApiService;

class EmployeeApiService extends ApiService
{
    protected static ?string $resource = EmployeeResource::class;

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
