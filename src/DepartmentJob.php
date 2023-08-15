<?php

namespace Dayplayer\BackendModels;

use App\Http\Resources\GigResource;
use Dayplayer\BackendModels\Profile;
use Dayplayer\BackendModels\Production;
use Dayplayer\BackendModels\Helpers\HelperFunctions;

class DepartmentJob extends BaseModel
{
    public $casts = [
        'profile_matches' => 'array',
    ];
        
    public static function startsTomorrow()
    {
        return DepartmentJob::where('from_date', '=', now()->addDays()->format('Y-m-d'))->get();
    }
    
    public static function ongoing()
    {
        return DepartmentJob::where('from_date', '<=', now()->format('Y-m-d'))
            ->where('to_date', '>', now()->format('Y-m-d'))->get();
    }
    
    public function getHourlyRateAttribute($value)
    {
        return (string) HelperFunctions::toDollars($value);
    }

    public function production(): \Illuminate\Database\Eloquent\Relations\BelongsTo|\Jenssegers\Mongodb\Relations\BelongsTo
    {
        return $this->belongsTo(Production::class);
    }
    
    public function updateMatchesAndReportChange()
    {
        $position = [$this->position];
        
        $newMatches = Profile::where('available', true)
            ->whereIn('positions', $position)
            ->select('id', 'bio', 'union', 'birthday', 'available', 'positions', 'phone_number', 'union_member_since')
            ->with('user:name')
            ->get()
            ->map(function ($profile) {
                return [
                    'id' => $profile->id,
                    'bio' => $profile->bio,
                    'union' => $profile->union,
                    'name' => $profile->user->name,
                    'birthday' => $profile->birthday,
                    'available' => $profile->available,
                    'positions' => $profile->positions,
                    'phone_number' => $profile->phone_number,
                    'union_member_since' => $profile->union_member_since
                ];
            })->all();
        
        $this->profile_matches = $newMatches;
        
        if ($this->isDirty('profile_matches')) {
            $this->save();
            return true;
        }

        return false;
    }
}
