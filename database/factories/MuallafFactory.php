<?php

namespace Database\Factories;

use App\Models\Muallaf;
use Illuminate\Database\Eloquent\Factories\Factory;

class MuallafFactory extends Factory
{
    protected $model = Muallaf::class;

    public function definition(): array
    {
        return [
            'IdPenggunaMain' => 0,
            'NamaIslam' => $this->faker->name(),
            'NamaAsal' => $this->faker->name(),
            'NoKP' => $this->faker->numerify('######-##-####'),
            'Daerah' => $this->faker->word(),
            'BilDaftar' => $this->faker->numerify('REF####'),
            'Jantina' => $this->faker->randomElement(['L', 'P']),
            'Bangsa' => $this->faker->randomElement(['Melayu', 'Arab', 'China', 'India']),
            'KategoriMuallaf' => $this->faker->randomElement(['Malaysia', 'Sabah', 'Sarawak', 'Orang Asli', 'Bukan Warganegara']),
            'NoTel1' => $this->faker->numerify('01#########'),
            'TarikhIslam' => $this->faker->date(),
            'Alamat1' => $this->faker->address(),
            'Alamat2' => null,
            'Alamat3' => null,
            'Poskod' => $this->faker->numerify('#####'),
            'Bandar' => $this->faker->city(),
            'Negeri' => $this->faker->state(),
            'KodBank' => $this->faker->numerify('###'),
            'NoAkaunBank' => $this->faker->numerify('###########'),
            'Pendakwah' => $this->faker->name(),
            'Catatan' => $this->faker->sentence(),
            'Status' => 'A',
        ];
    }
}
