<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vet>
 */
class VetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenis_kelamin = $this->faker->boolean();
        return [
            'nama' => $jenis_kelamin
                ? $this->faker->firstNameMale() . ' ' . $this->faker->lastName()
                : $this->faker->firstNameFemale() . ' ' . $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'no_telp' => '08' . $this->faker->numerify('##########'),
            'alamat' => $this->faker->address(),
            'STR' => 'STR-' . $this->faker->unique()->numerify('######'),
            'SIP' => 'SIP-' . $this->faker->unique()->numerify('######'),
            'alumni' => $this->faker->randomElement([
                'Universitas Gadjah Mada',
                'IPB University',
                'Universitas Airlangga',
                'Universitas Brawijaya'
            ]),
            'harga' => $this->faker->numberBetween(50000, 250000),
            'jenis_kelamin' => $jenis_kelamin,
            'foto' => $this->faker->imageUrl(640, 480, 'people', true, 'vet'), // Lebih cocok
            'tgl_lahir' => $this->faker->dateTimeBetween('-45 years', '-25 years')->format('Y-m-d'),
            'deskripsi' => $this->faker->paragraph(),
        ];
    }
}
