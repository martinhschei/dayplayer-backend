<?php

namespace Dayplayer\BackendModels\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class CountryCodes
{
    public function list()
    {
        $cacheKey = 'formatted_country_codes';
        
        $data = Cache::remember($cacheKey, 60 * 24, function () {
            $countries = Storage::disk('public')->get('country_codes.txt');
            
            if (is_null($countries)) {
                return [];
            }
            
            return $this->sort($this->format($countries));
        });
        
        return $data;
    }

    private function format($countries)
    {
        $list = collect(explode("\n", $countries));
        
        $list = $list->reject(function ($country) {
            return str_starts_with($country, "#");
        });
        
        return $list->map(function ($country) {
            $parts = explode(",", $country);

            if (is_null($parts) || count($parts) !== 2) {
                return [
                    'name' => "",
                    'country_code' => "",
                ];
            }

            return [
                'name' => $parts[0],
                'country_code' => $parts[1],
            ];
        })->reject(function ($country) {
            return $country['name'] == "";
        });
    }

    private function sort($countries)
    {
        $topCountries = [
            'United States',
            'Mexico',
            'United Kingdom',
            'Canada', 
        ];
    
        $preferred = $countries->filter(function ($country) use ($topCountries) {
            return in_array($country['name'], $topCountries);
        });
    
        $preferredSorted = $preferred->sortBy(function ($country) use ($topCountries) {
            return array_search($country['name'], $topCountries);
        });

        $others = $countries->reject(function ($country) use ($topCountries) {
            return in_array($country['name'], $topCountries);
        });
        
        return $preferredSorted->merge($others)->values()->all();
    }
}