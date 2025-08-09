<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Ticket;


/**
 * Class State
 *
 * @property $id
 * @property $name
 * @property $created_at
 * @property $updated_at
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class State extends Model
{
    use SoftDeletes;
    
    public static $rules = [
        'name' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];



    public function tickets()
{
    return $this->hasMany(Ticket::class);
}
}
