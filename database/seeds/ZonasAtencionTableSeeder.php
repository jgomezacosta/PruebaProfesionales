<?php

use Illuminate\Database\Seeder;

class ZonasAtencionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('zonas_atencion')->insert(['nombre' => 'Caba' ]);
        DB::table('zonas_atencion')->insert(['nombre' => 'Gran Buenos Aires' ]);
        DB::table('zonas_atencion')->insert(['nombre' => 'Zona Norte' ]);
        DB::table('zonas_atencion')->insert(['nombre' => 'Zona Sur' ]);
        DB::table('zonas_atencion')->insert(['nombre' => 'Zona Este' ]);
        DB::table('zonas_atencion')->insert(['nombre' => 'Zona Oeste' ]);

    }
}
