<?php

namespace Dayplayer\BackendModels\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

trait HasPackageFactory
{
    use HasFactory;

    protected static function newFactory()
    {
        $modelName = Str::after(get_called_class(), 'Models\\');
        $path = 'Database\\Factories\\Dayplayer\\BackendModels'.$modelName.'Factory';

        return $path::new();
    }
}
