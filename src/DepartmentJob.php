<?php

namespace Dayplayer\BackendModels;

use App\Http\Resources\GigResource;
use Dayplayer\BackendModels\Booking;
use Dayplayer\BackendModels\Profile;
use Dayplayer\BackendModels\BaseModel;
use Dayplayer\BackendModels\Department;
use Dayplayer\BackendModels\Production;
use Dayplayer\BackendModels\DepartmentJob;
use Dayplayer\BackendModels\JobProfileMatch;
use Dayplayer\BackendModels\Helpers\HelperFunctions;
use Dayplayer\BackendModels\Events\DepartmentJobUpdatedMatchRelevantData;

class DepartmentJob extends BaseModel
{
    public $casts = [
        'profile_matches' => 'array',
    ];
    
    protected static function booted()
    {
        static::updated(function ($departmentJob) {
            if ($departmentJob->isDirty(['position'])) {
                event(new DepartmentJobUpdatedMatchRelevantData($departmentJob));
            }
        });
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
    public function production()
    {
        return $this->belongsTo(Production::class);
    }

    public function booking()
    {
        return $this->hasOneThrough(
            Booking::class,
            JobProfileMatch::class,
            'department_job_id',
            'job_profile_match_id',
            'id',
            'id'
        );
    }

    public function profileMatches()
    {
        return $this->hasMany(JobProfileMatch::class);
    }

    public function getHourlyRateAttribute($value)
    {
        return (string) HelperFunctions::toDollars($value);
    }
    
    public static function ongoing()
    {
        return DepartmentJob::where('from_date', '<=', now()->format('Y-m-d'))
            ->where('to_date', '>', now()->format('Y-m-d'))->get();
    }

    public static function startsTomorrow()
    {
        return DepartmentJob::where('from_date', '=', now()->addDays()->format('Y-m-d'))->get();
    }

    public function updateMatches()
    {
        if ($this->booking) {
            return;
        }
        
        $matchIdsToDelete = [];
        $position = [$this->position];

        // Part 2: Check if current matches are still valid
        foreach ($this->profileMatches()->with('profile')->get()as $profileMatch) {
            if ($profileMatch->profile->available == false || !in_array($this->position, $profileMatch->profile->positions)) {
                $matchIdsToDelete[] = $profileMatch->id;
            }
        }
        
        if (count($matchIdsToDelete) > 0) {
            JobProfileMatch::whereIn('id', $matchIdsToDelete)->delete();
        }
        
        // Fetch the updated list of currently matched profile IDs after validation
        $currentMatchedProfileIds = $this->profileMatches()->pluck('profile_id')->toArray();

        // Part 1: Find new matches
        // Directly exclude profiles that are already matched using whereNotIn
        $matches = Profile::where('available', true)
            ->whereJsonContains('positions', $position)
            ->whereNotIn('id', $currentMatchedProfileIds)
            ->pluck('id')
            ->toArray();
        
        $newMatchesData = [];
        foreach ($matches as $profileId) {
            $newMatchesData[] = [
                'profile_id' => $profileId,
                'department_job_id' => $this->id,
            ];
        }

        if (count($newMatchesData) > 0) {
            JobProfileMatch::insert($newMatchesData);
        }
    }    
}