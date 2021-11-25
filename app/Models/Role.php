<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Cache;

class Role extends Model
{
    use HasRoles;

    protected $guarded = [];

    /**
     * @return mixed
     */
    public function getCacheRoles()
    {
        return Cache::remember('roles', now()->addDay(), function () {
            return $this->all();
        });
    }
}
