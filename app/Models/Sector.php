<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Sector
 *
 * @property $id
 * @property $name
 * @property $created_at
 * @property $updated_at
 * @property Item[] $items
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Sector extends Model
{   
    use SoftDeletes;

    public static $rules = [
        'name' => 'required|unique:sectors,name',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany('App\Models\Item', 'sector_id', 'id');
    }

    public function toSearchableArray(): array
    {
        $array = $this->toArray();

        // Customize the data array...
        return [

            'name' => $this->name,

        ];

        return $array;
    }
}
