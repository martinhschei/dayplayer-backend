<?php

namespace Dayplayer\BackendModels;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MongoDbModel extends Model
{
    use HasFactory;


    protected $connection = 'mongodb';
}
