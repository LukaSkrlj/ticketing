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
        $contact = Contact::all()->random();
        $user_id = $contact->user_id;
        $ticket_type_id = TicketType::all()->random()->id;

        return [
            'user_id' => $user_id,
            'contact_id' => $contact->id,
            'type' => $ticket_type_id,
            'name' => $this->faker->word,
            'description' => $this->faker->text(250),
            'due_date' => $this->faker->dateTimeBetween('-1 days','+5 days'),
            'is_done' => $this->faker->boolean(20),
        ];
    }
}
