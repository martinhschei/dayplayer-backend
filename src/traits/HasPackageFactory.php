<?php

namespace Dayplayer\BackendModels\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

trait HasPackageFactory
{
    use HasFactory;

    protected static function newFactory()
    {
        // $package = Str::before(get_called_class(), 'Models\\');
        $modelName = Str::after(get_called_class(), 'Models\\');
        dd($modelName);
        $path = 'Database\\Factories\\Dayplayer\\BackendModels'.$modelName.'Factory';

        return $path::new();
    }
}
