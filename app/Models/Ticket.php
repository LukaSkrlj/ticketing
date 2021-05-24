<?php

namespace App\Models;
use App\Events\TicketCreated;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tickets';
    protected $primaryKey = 'id';
    protected $dispatchesEvents = [
        'created' => TicketCreated::class,
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(TicketType::class, 'type');
    }

    public function path(): string
    {
        return route('tickets.show', $this);
    }
}
