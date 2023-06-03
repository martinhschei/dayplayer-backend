<?php

namespace Dayplayer\BackendModels;

use Dayplayer\BackendModels\DepartmentJob;

class Department extends BaseModel
{
    public function jobs()
    {
        return $this->hasMany(DepartmentJob::class);
    }
    
    public function manager()
    {
        return [
            'name' => $this->manager_name,
            'email' => $this->manager_email,
        ];
    }
    
    public function managerAsUser()
    {
        return User::where('email', $this->manager_email)->first();
    }
}
