<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use App\Models\State;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

     use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role_id',
        'position_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class, 'operator_id');
    }

      public function position()
    {
        // return $this->belongsTo('App\Models\Position', 'id', 'position_id');
        return $this->belongsTo(Position::class, 'position_id');
    }
       public function binnacles()
    {
        return $this->hasMany('App\Models\Binnacle', 'id', 'user_id');
    }

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'ticket_user')
                    ->withPivot('role_in_ticket', 'assigned_at')
                    ->withTimestamps();
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function canAccessModule($module)
    {
        $access = [
                'Administrador' => ['kanban','users','parts' ,'items', 'operators', 'tickets','sectors','states','providers','positions'],
                'Encargado' => ['binnacles', 'tickets'],
                'Tecnico' => ['tickets','binnacles','parts','items']
        ];

        // return isset($access[$this->role->name]) && in_array($module, $access[$this->role->name]);
        $roleName = $this->role?->name;
        if (!isset($access[$roleName])) {
            return false;
        }

        return in_array($module, $access[$roleName]);

    }
}
