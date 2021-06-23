<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table("cities")->delete();
        $json = File::get("database/data/cities.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            if(!City::find($obj->id)){
                if(State::find($obj->stateId)){
                    City::create(array(
                        'cityId' => $obj->id,
                        'name' => $obj->name,
                        'stateId' => $obj->stateId,
                    ));
                }
            }
        }
        $json = File::get("database/data/cities2.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            if(!City::find($obj->id)){
                if(State::find($obj->stateId)){
                    City::create(array(
                        'cityId' => $obj->id,
                        'name' => $obj->name,
                        'stateId' => $obj->stateId,
                    ));
                }
            }
        }

        $json = File::get("database/data/cities3.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            if(!City::find($obj->id)){
                if(State::find($obj->stateId)){
                    City::create(array(
                        'cityId' => $obj->id,
                        'name' => $obj->name,
                        'stateId' => $obj->stateId,
                    ));
                }
            }
        }

        $json = File::get("database/data/cities4.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            if(!City::find($obj->id)){
                if(State::find($obj->stateId)){
                    City::create(array(
                        'cityId' => $obj->id,
                        'name' => $obj->name,
                        'stateId' => $obj->stateId,
                    ));
                }
            }
        }

    }
}
