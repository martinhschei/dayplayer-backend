<?php

namespace Dayplayer\BackendModels;

class Profile extends MongoDbModel
{
    public $casts = [
        'boolean' => 'available',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo|\Jenssegers\Mongodb\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function conversations(): \Jenssegers\Mongodb\Relations\BelongsToMany|\Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Conversation::class);
    }

    public function productions(): \Illuminate\Database\Eloquent\Relations\HasMany|\Jenssegers\Mongodb\Relations\HasMany
    {
        return $this->hasMany(Production::class);
    }
}
