<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class Provider
 * @package App\Models
 * @version March 16, 2022, 11:19 am UTC
 *
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property string $image
 * @property string $notes
 * @property tinyinteger $approve
 * @property tinyinteger $block
 * @property string $block_notes
 * @property string $email_verification_code
 * @property string $phone_verification_code
 * @property string $email_verified_at
 * @property string $phone_verified_at
 * @property varchar $remember_token
 */
class Provider extends Authenticatable
{
    use HasFactory, Notifiable;

    public $table = 'providers';

    public $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'image',
        'notes',
        'approve',
        'block',
        'block_notes',
        'email_verification_code',
        'phone_verification_code',
        'email_verified_at',
        'phone_verified_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'password' => 'string',
        'image' => 'string',
        'notes' => 'string',
        'approve' => 'boolean',
        'block' => 'boolean',
        'block_notes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => ['required','string','max:255'],
        'email' => ['required','string','max:255','email','unique:providers,email'],
        'phone' => ['required','string','max:255','regex:/^(?:\+971|00971|0)?(?:50|51|52|55|56|2|3|4|6|7|9)\d{7}$/m','unique:providers,phone'],
        'password' => ['required','string','min:8','max:255'],
        'image' => ['nullable','image'],
        'notes' => ['nullable','string'],
        'approve' => ['nullable','boolean'],
        'block' => ['nullable','boolean'],
        'block_notes' => ['nullable','required_if:block,1','string'],
        'email_verification_code' => ['nullable','string','max:100'],
        'phone_verification_code' => ['nullable','string','max:100'],
        'email_verified_at' => ['nullable','date_format:Y-m-d'],
        'phone_verified_at' => ['nullable','date_format:Y-m-d']
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'name' => ['required','string','max:255'],
        'email' => ['required','string','max:255','email','unique:providers,email'],
        'phone' => ['required','string','max:255','regex:/^(?:\+971|00971|0)?(?:50|51|52|55|56|2|3|4|6|7|9)\d{7}$/m','unique:providers,phone'],
        'password' => ['nullable','string','min:8','max:255'],
        'image' => ['nullable','image'],
        'notes' => ['nullable','string'],
        'approve' => ['nullable','boolean'],
        'block' => ['nullable','boolean'],
        'block_notes' => ['nullable','required_if:block,1','string'],
        'email_verification_code' => ['nullable','string','max:100'],
        'phone_verification_code' => ['nullable','string','max:100'],
        'email_verified_at' => ['nullable','date_format:Y-m-d'],
        'phone_verified_at' => ['nullable','date_format:Y-m-d']
    ];

    public function getBlockSpanAttribute()
    {
        if(!$this->block) return '<span class="label label-success">'.__('msg.active').'</span>';
        return '<span class="label label-danger">'.__('msg.blocked').'</span>';
    }

    public function getApproveSpanAttribute()
    {
        if($this->approve) return '<span class="label label-success">'.__('models/providers.approved').'</span>';
        return '<span class="label label-warning">'.__('models/providers.unapproved').'</span>';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class, 'provider_id');
    }

    public function getNotifications($read = -1, $skip = null, $limit = null)
    {
        $query = \App\Models\Notification::where('to', 'provider')
            ->where(function($query) {
                $query->where('provider_id', null)
                      ->orWhere('provider_id', $this->id);
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
