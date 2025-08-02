<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

/**
 * Class Provider
 *
 * @property $id
 * @property $name
 * @property $phone
 * @property $adress
 * @property $location
 * @property $country
 * @property $created_at
 * @property $updated_at
 * @property Item[] $items
 * @property Part[] $parts
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Provider extends Model
{
    use Searchable;
    use SoftDeletes;

    public static $rules = [
        'name' => 'required',
        'phone' => 'required',
        'adress' => 'required',
        'location' => 'required',
        'country' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'phone', 'adress', 'location', 'country'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany('App\Models\Item', 'provider_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parts()
    {
        return $this->hasMany('App\Models\Part', 'provider_id', 'id');
    }

    public function toSearchableArray(): array
    {
        $array = $this->toArray();

        // Customize the data array...
        return [

            'name' => $this->name,
            'adress' => $this->adress,

        ];

        return $array;
    }
}
