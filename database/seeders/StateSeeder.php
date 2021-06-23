<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table("states")->delete();
        $json = File::get("database/data/states.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            if(!State::find($obj->id)){
                if(Country::find($obj->countryId)){
                    State::create(array(
                        'stateId' => $obj->id,
                        'name' => $obj->name,
                        'countryId' => $obj->countryId,
                    ));
                }
            }
        }
    }
}
