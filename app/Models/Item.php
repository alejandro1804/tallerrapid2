<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\Storage;

/**
 * Class Item
 *
 * @property $id
 * @property $name
 * @property $sector_id
 * @property $characteristic
 * @property $note
 * @property $trademark
 * @property $provider_id
 * @property $created_at
 * @property $updated_at
 * @property Part[] $parts
 * @property Provider $provider
 * @property Sector $sector
 * @property Ticket[] $tickets
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Item extends Model
{
    use Searchable;
    use HasFactory;

    public static $rules = [
        'name' => 'required',
        'sector_id' => 'required',
        'characteristic' => '',
        'note' => '',
        'trademark' => '',
        'provider_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'sector_id', 'characteristic', 'note', 'trademark', 'provider_id','image'];


     protected static function boot()
    {
        parent::boot();
        static::deleting(function ($item) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
        });
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parts()
    {
        return $this->hasMany('App\Models\Part', 'item_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function provider()
    {
        return $this->hasOne('App\Models\Provider', 'id', 'provider_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sector()
    {
        return $this->hasOne('App\Models\Sector', 'id', 'sector_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket', 'item_id', 'id');
    }

    public function toSearchableArray(): array
    {
        $array = $this->toArray();

        // Customize the data array...
        return [

            'name' => $this->name,
            'trademark' => $this->trademark,

        ];

        return $array;
    }
}
