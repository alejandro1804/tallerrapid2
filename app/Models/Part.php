<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * Class Part
 *
 * @property $id
 * @property $item_id
 * @property $name
 * @property $note
 * @property $provider_id
 * @property $created_at
 * @property $updated_at
 * @property Item $item
 * @property Provider $provider
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Part extends Model
{
    use Searchable;

    public static $rules = [
        'item_id' => 'required|exists:items,id',
        'name' => 'required',
        'note' => 'nullable',
        'provider_id' => 'required',
    ];

    protected $perPage = 7;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['item_id', 'name', 'note', 'provider_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function item()
    {
        return $this->hasOne('App\Models\Item', 'id', 'item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function provider()
    {
        return $this->hasOne('App\Models\Provider', 'id', 'provider_id');
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize the data array...
        return [

            'name' => $this->name,
            'item_id' => $this->item_id,

        ];

        return $array;
    }
}
