<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Contact
 * @package App\Models
 * @version March 21, 2022, 6:22 am UTC
 *
 * @property string $name
 * @property string $email
 * @property string $type
 * @property string $subject
 * @property string $message
 * @property string $read_at
 * @property string $reply_message
 */
class Contact extends Model
{
    use HasFactory;

    public $table = 'contacts';
    

    public $fillable = [
        'name',
        'email',
        'type',
        'subject',
        'message',
        'read_at',
        'reply_message'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'type' => 'string',
        'subject' => 'string',
        'message' => 'string',
        'reply_message' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255|email',
        'type' => 'nullable|string|in:contact,complaint,enquiry,suggestion,help',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
        'read_at' => 'nullable|date_format:Y-m-d',
        'reply_message' => 'nullable|string'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'type' => 'nullable|string|in:contact,complaint,enquiry,suggestion,help',
        'reply_message' => 'nullable|string'
    ];

    
}
