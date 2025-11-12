<?php

namespace Database\Seeders;

use App\Models\Crm\States;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        States::insert([
            // TODO: S US States seeder
            ["country_code" => "US", "state_name" => "Alabama", "state_code" => "AL"],
            ["country_code" => "US", "state_name" => "Alaska", "state_code" => "AK"],
            ["country_code" => "US", "state_name" => "Arizona", "state_code" => "AZ"],
            ["country_code" => "US", "state_name" => "Arkansas", "state_code" => "AR"],
            ["country_code" => "US", "state_name" => "California", "state_code" => "CA"],
            ["country_code" => "US", "state_name" => "Colorado", "state_code" => "CO"],
            ["country_code" => "US", "state_name" => "Connecticut", "state_code" => "CT"],
            ["country_code" => "US", "state_name" => "Delaware", "state_code" => "DE"],
            ["country_code" => "US", "state_name" => "District of Columbia", "state_code" => "DC"],
            ["country_code" => "US", "state_name" => "Florida", "state_code" => "FL"],
            ["country_code" => "US", "state_name" => "Georgia", "state_code" => "GA"],
            ["country_code" => "US", "state_name" => "Hawaii", "state_code" => "HI"],
            ["country_code" => "US", "state_name" => "Idaho", "state_code" => "ID"],
            ["country_code" => "US", "state_name" => "Illinois", "state_code" => "IL"],
            ["country_code" => "US", "state_name" => "Indiana", "state_code" => "IN"],
            ["country_code" => "US", "state_name" => "Iowa", "state_code" => "IA"],
            ["country_code" => "US", "state_name" => "Kansas", "state_code" => "KS"],
            ["country_code" => "US", "state_name" => "Kentucky", "state_code" => "KY"],
            ["country_code" => "US", "state_name" => "Louisiana", "state_code" => "LA"],
            ["country_code" => "US", "state_name" => "Maine", "state_code" => "ME"],
            ["country_code" => "US", "state_name" => "Maryland", "state_code" => "MD"],
            ["country_code" => "US", "state_name" => "Massachusetts", "state_code" => "MA"],
            ["country_code" => "US", "state_name" => "Michigan", "state_code" => "MI"],
            ["country_code" => "US", "state_name" => "Minnesota", "state_code" => "MN"],
            ["country_code" => "US", "state_name" => "Mississippi", "state_code" => "MS"],
            ["country_code" => "US", "state_name" => "Missouri", "state_code" => "MO"],
            ["country_code" => "US", "state_name" => "Montana", "state_code" => "MT"],
            ["country_code" => "US", "state_name" => "Nebraska", "state_code" => "NE"],
            ["country_code" => "US", "state_name" => "Nevada", "state_code" => "NV"],
            ["country_code" => "US", "state_name" => "New Hampshire", "state_code" => "NH"],
            ["country_code" => "US", "state_name" => "New Jersey", "state_code" => "NJ"],
            ["country_code" => "US", "state_name" => "New Mexico", "state_code" => "NM"],
            ["country_code" => "US", "state_name" => "New York", "state_code" => "NY"],
            ["country_code" => "US", "state_name" => "North Carolina", "state_code" => "NC"],
            ["country_code" => "US", "state_name" => "North Dakota", "state_code" => "ND"],
            ["country_code" => "US", "state_name" => "Ohio", "state_code" => "OH"],
            ["country_code" => "US", "state_name" => "Oklahoma", "state_code" => "OK"],
            ["country_code" => "US", "state_name" => "Oregon", "state_code" => "OR"],
            ["country_code" => "US", "state_name" => "Pennsylvania", "state_code" => "PA"],
            ["country_code" => "US", "state_name" => "Rhode Island", "state_code" => "RI"],
            ["country_code" => "US", "state_name" => "South Carolina", "state_code" => "SC"],
            ["country_code" => "US", "state_name" => "South Dakota", "state_code" => "SD"],
            ["country_code" => "US", "state_name" => "Tennessee", "state_code" => "TN"],
            ["country_code" => "US", "state_name" => "Texas", "state_code" => "TX"],
            ["country_code" => "US", "state_name" => "Utah", "state_code" => "UT"],
            ["country_code" => "US", "state_name" => "Vermont", "state_code" => "VT"],
            ["country_code" => "US", "state_name" => "Virginia", "state_code" => "VA"],
            ["country_code" => "US", "state_name" => "Washington", "state_code" => "WA"],
            ["country_code" => "US", "state_name" => "West Virginia", "state_code" => "WV"],
            ["country_code" => "US", "state_name" => "Wisconsin", "state_code" => "WI"],
            ["country_code" => "US", "state_name" => "Wyoming", "state_code" => "WY"],
            // TODO: E US States seeder
        ]);
    }
}
