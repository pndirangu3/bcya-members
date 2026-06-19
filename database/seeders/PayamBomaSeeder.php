<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payam;
use App\Models\Boma;

class PayamBomaSeeder extends Seeder
{
    public function run(): void
    {

$data = [

    'Jalle Payam' => [
        'Jalle Boma',
        'Kuei Boma',
        'Kolmerek',
        'Akuaideng'
    ],

    'Baidit Payam' => [
        'Mathiang Boma',
        'Tong Boma',
        'Many ë Deng Boma',
        'Makol Chuei Boma'
    ],

    'Makuach Payam' => [
        'Makuach Boma',
        'Konbeek Boma',
        'Majak Boma',
        'Lualdit',
        'Kapaat',
        'Werkok',
        'Mading'
    ],

    'Anyidi Payam' => [
        'Mareng Boma',
        'Thianwei',
        'Cuei Magon'
    ],

    'Kolnyang Payam' => [
        'Gak Boma',
        'Malual Chaat',
        'Kolnyang South',
        'Kolnyang North'
    ],

    'Cuei Keer Payam' => [
        'Goi Boma',
        'Pariak South',
        'Pariak North',
        'Cuei Keer',
        'Abii'
    ],


];


        foreach ($data as $payamName => $bomas)
        {
            $payam = Payam::create([
                'name' => $payamName
            ]);

            foreach ($bomas as $bomaName)
            {
                Boma::create([
                    'payam_id' => $payam->id,
                    'name' => $bomaName
                ]);
            }
        }
    }
}
