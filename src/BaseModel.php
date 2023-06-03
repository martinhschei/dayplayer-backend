<?php

namespace Dayplayer\BackendModels;

use Illuminate\Database\Eloquent\Model;
use Dayplayer\BackendModels\Traits\HasPackageFactory;

class BaseModel extends Model
{
    use HasPackageFactory;
    
    public $guarded = [];
}