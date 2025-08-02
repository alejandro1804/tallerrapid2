<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Position
 *
 * @property $id
 * @property $name
 * @property $created_at
 * @property $updated_at
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Position extends Model
{
    use Searchable;
    use SoftDeletes;

    

    protected $table = 'positions';

    protected $primaryKey = 'id'; // Asegúrate de que esto coincida con la columna en la BD

    public static $rules = [
        'name' => 'required'
    ];

    protected $perPage = 7;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany('App\Models\User', 'user_id', 'id');
    }
}
