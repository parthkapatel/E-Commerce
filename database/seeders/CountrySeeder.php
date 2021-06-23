<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table("countries")->delete();
        $json = File::get("database/data/countries.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            if (!Country::find($obj->id)) {
                Country::create(array(
                    'countryId' => $obj->id,
                    'sortname' => $obj->sortname,
                    'name' => $obj->name,
                    'phoneCode' => $obj->phoneCode,
                ));
            }
        }
    }
}
