<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = array('name');
    /**
     * @var int|mixed
     */
    protected $table = 'contacts';
    protected $primaryKey = 'id';

    public function path(): string
    {
        return route('contacts.show', $this);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the contact's full name.
     *
     * @return string
     */
    public function getNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
