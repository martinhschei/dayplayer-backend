<?php

namespace Dayplayer\BackendModels;

use App\Http\Resources\GigResource;
use Dayplayer\BackendModels\Profile;
use Dayplayer\BackendModels\Production;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

class DepartmentJob extends BaseModel
{
    public $casts = [
        'profile_matches' => 'array',
    ];
    
    public static function matcheshWithProfile(Profile $profile)
    {
        return DepartmentJob::with('production')->whereIn('position', $profile->positions)
            ->where('from_date', '>', now()->format('Y-m-d'))->get();            
    }
    
    public static function startsTomorrow()
    {
        return DepartmentJob::where('from_date', '=', now()->addDays()->format('Y-m-d'))->get();
    }
    
    public static function ongoing()
    {
        return DepartmentJob::where('from_date', '<=', now()->format('Y-m-d'))
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
                        'name' => $profile->user->name,
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
