<?php

namespace App\Repositories;

use App\Models\Provider;
use App\Repositories\BaseRepository;

/**
 * Class ProviderRepository
 * @package App\Repositories
 * @version March 16, 2022, 11:19 am UTC
*/

class ProviderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'phone',
        'image',
        'notes',
        'approve',
        'block',
        'block_notes',
        'email_verification_code',
        'phone_verification_code',
        'email_verified_at',
        'phone_verified_at',
        'remember_token'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Provider::class;
    }
}
