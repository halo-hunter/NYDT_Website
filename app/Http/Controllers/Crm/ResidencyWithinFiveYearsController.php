<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Crm\Client;
use App\Models\Crm\Country;
use App\Models\Crm\EmploymentWithinLastFiveYears;
use App\Models\Crm\ResidencyWithinFiveYears;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResidencyWithinFiveYearsController extends Controller
{
    public function edit(Request $request, int $item_id)
    {
        $item = ResidencyWithinFiveYears::find($item_id);

        $data = [
            'item_id' => $item_id,
            'item' => $item,
            'countries' => Country::all()
        ];

        return view('crm.pages.residency-within-five-years.update', $data);
    }

    public function update(Request $request, int $item_id)
    {

        $validator = Validator::make($request->all(), [
            'number_and_street' => 'required',
            'city_town' => 'required',
            'department_province_or_state' => 'required',
            'country_id' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        ResidencyWithinFiveYears::where('id', $item_id)->update([
            'number_and_street' => $request->number_and_street,
            'city_town' => $request->city_town,
            'department_province_or_state' => $request->department_province_or_state,
            'country_id' => $request->country_id,
            'from' => $request->from,
            'to' => $request->to,
            'updated_at' => now(),
        ]);

        $item = ResidencyWithinFiveYears::find($item_id);
        $client_id = $item->client()->first()->id;

        return redirect()->route('clients->edit', $client_id)->withErrors([
            "employment_within_last_five_years_updated_successfully" => "Employment Within Last 5 Years Updated Successfully"
        ]);

    }

    public function delete(Request $request, $item_id)
    {

        $item = ResidencyWithinFiveYears::find($item_id);

        $data = [
            'item_id' => $item_id,
            'item' => $item
        ];

        return view('crm.pages.residency-within-five-years.delete', $data);

    }

    public function destroy(Request $request, $item_id)
    {
        $item = ResidencyWithinFiveYears::find($item_id);
        $client_id = $item->client()->first()->id;

        $client = Client::find($client_id);
        $client->residency_within_five_years()->detach($item_id);

        ResidencyWithinFiveYears::where('id', $item_id)->delete();

        return redirect()->route('clients->edit', $client_id)->withErrors([
            "residency_within_five_years_deleted_successfully" => "Residency Within 5 Years Deleted Successfully"
        ]);



    }
}
