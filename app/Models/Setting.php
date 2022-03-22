<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Setting
 * @package App\Models
 * @version August 22, 2021, 7:59 am UTC
 */
class Setting extends Model
{
    use HasFactory;

    public $table = 'settings';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'key',
        'value',
        'type',
        'group',
        'description',
        'rules'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'key' => 'string',
        'value' => 'string',
        'type' => 'string',
        'group' => 'string',
        'description' => 'string',
        'rules' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'key' => 'required|string|max:255',
        'value' => 'nullable|string',
        'type' => 'nullable|string|in:text,number,email,textarea,editor,checkbox,file,url',
        'group' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:255',
        'rules' => 'nullable|string|max:255'
    ];

    public static function values($key)
    {
        if(!is_null($setting = \App\Models\Setting::where('key', $key)->first())) return $setting->value;
        return null;
    }
}
