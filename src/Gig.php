<?php

namespace Dayplayer\BackendModels;

use App\Models\Profile;
use App\Models\MongoDbModel;
use App\Http\Resources\GigResource;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

class Gig extends MongoDbModel
{
    use DefaultOrderBy;
    
    protected static $orderByColumn = 'from_date';
    protected static $orderByColumnDirection = 'desc';
    
    public static function matcheshWithProfile(Profile $profile)
    {
        return Gig::with('production')->whereIn('position', $profile->positions)
            ->where('from_date', '>', now()->format('Y-m-d'))->get();            
    }
    
    public static function startsTomorrow()
    {
        return Gig::where('from_date', '=', now()->addDays()->format('Y-m-d'))->get();
    }
    
    public static function ongoing()
    {
        return Gig::where('from_date', '<=', now()->format('Y-m-d'))
            ->where('to_date', '>', now()->format('Y-m-d'))->get();
    }

    public function production(): \Illuminate\Database\Eloquent\Relations\BelongsTo|\Jenssegers\Mongodb\Relations\BelongsTo
    {
        return $this->belongsTo(Production::class);
    }
    
    public function updateMatches()
    {
        $profiles = Profile::where('available', true)
            ->whereIn('positions', explode(",", $this->position))
            ->get()->map(function ($profile) {
                    return [
                        'id' => $profile->_id,
                        'bio' => $profile->bio,
                        'union' => $profile->union,
                        'birthday' => $profile->birthday,
                        'available' => $profile->available,
                        'positions' => $profile->positions,
                        'last_name' => $profile->last_name,
                        'first_name' => $profile->first_name,
                        'phone_number' => $profile->phone_number,
                        'union_member_since' => $profile->union_member_since
                    ];
                })->all();
        
        $this->update([
            'profile_matches' => $profiles
        ]);

        $this->save();
    }
}
