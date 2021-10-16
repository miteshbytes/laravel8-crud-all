<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $gender = $this->faker->randomElement(['male', 'female']);
        // $city   = $this->faker->randomElement(['Ahmedabad', 'Mehsana', 'Surat', 'Rajkot', 'Patan', 'Surendranagar']);
        // $hobbies = implode(",", $this->faker->randomElements(['Playing', 'Reading', 'Travelling', 'Photography', 'Dancing'], 2));  // If want to save as string

        return [
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'email'      => $this->faker->unique()->safeEmail(),
            'password'   => '$2y$10$M6vV1fHhZg/lXoXqHGx/pOeHC55IzK5VU.CGpjtPbQFx3dHJBah/K',  // Test@123
            'phone'      => $this->faker->numerify('##########'),
            'gender'     => $this->faker->randomElement(['male', 'female']),
            'city'       => $this->faker->randomElement(['Ahmedabad', 'Mehsana', 'Surat', 'Rajkot', 'Patan', 'Surendranagar']),
            'skills'     => $this->faker->randomElements(['Laravel', 'JQuery', 'Bootstrap', 'Codeigniter', 'JQuery UI'], 2),
            'hobbies'    => $this->faker->randomElements(['Playing', 'Reading', 'Travelling', 'Photography', 'Dancing'], 2),
            'about_us'   => $this->faker->sentence(20),
            'image'      => 'default.jpg',
            'is_active'  => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
