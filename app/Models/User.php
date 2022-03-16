<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'image',
        'password',
        'notes',
        'block',
        'block_notes'
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
    ];

    public static $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        'phone' => ['required', 'string', 'max:255', 'regex:/^(?:\+971|00971|0)?(?:50|51|52|55|56|2|3|4|6|7|9)\d{7}$/m', 'unique:users,phone'],
        'image' => ['nullable', 'image'],
        'password' => ['required', 'string', 'min:8', 'max:255'],
        'block' => ['nullable', 'boolean'],
        'block_notes' => ['nullable', 'required_if:block,1', 'string'],
        'notes' => ['nullable', 'string']
    ];

    public static $update_rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        'phone' => ['required', 'string', 'max:255', 'regex:/^(?:\+971|00971|0)?(?:50|51|52|55|56|2|3|4|6|7|9)\d{7}$/m', 'unique:users,phone'],
        'image' => ['nullable', 'image'],
        'password' => ['nullable', 'string', 'min:8', 'max:255'],
        'block' => ['nullable', 'boolean'],
        'block_notes' => ['nullable', 'required_if:block,1', 'string'],
        'notes' => ['nullable', 'string']
    ];

    public function getBlockSpanAttribute()
    {
        if(!$this->block) return '<span class="label label-success">'.__('msg.active').'</span>';
        return '<span class="label label-danger">'.__('msg.blocked').'</span>';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class, 'user_id');
    }

    public function getNotifications($read = -1, $skip = null, $limit = null)
    {
        $query = \App\Models\Notification::where('to', 'user')
            ->where(function($query) {
                $query->where('user_id', null)
                      ->orWhere('user_id', $this->id);
            });

        if($read != -1) {
            $query->where('read_at', $read ? '!=' : '=', null);
        }

        if (!is_null($skip)) {
            $query->skip($skip);
        }

        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return $query;
    }
}
