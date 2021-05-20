<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $contact_id = Contact::all()->random(1)->first()->id;
        $user_id = Contact::query()->find($contact_id)->user_id;
        $ticket_type_id = TicketType::all()->random(1)->first()->id;

        return [
            'user_id' => $user_id,
            'contact_id' => $contact_id,
            'type' => $ticket_type_id,
            'name' => $this->faker->word,
            'description' => $this->faker->text(250),
        ];
    }
}
