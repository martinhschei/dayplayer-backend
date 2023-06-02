<?php

namespace Dayplayer\BackendModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BaseModel extends Model
{
    use HasFactory;
    
    public $guarded = [];
}