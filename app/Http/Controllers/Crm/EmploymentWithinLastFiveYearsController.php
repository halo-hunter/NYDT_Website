<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Crm\CaseModel;
use App\Models\Crm\Client;
use App\Models\Crm\EmploymentWithinLastFiveYears;
use App\Models\Crm\EntryDate;
use App\Models\Crm\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmploymentWithinLastFiveYearsController extends Controller
{
    public function edit(Request $request, int $item_id)
    {
        $item = EmploymentWithinLastFiveYears::find($item_id);

        $data = [
            'item_id' => $item_id,
            'item' => $item,
        ];

        return view('crm.pages.employment-within-last-five-years.update', $data);
    }

    public function update(Request $request, int $item_id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address_of_employer' => 'required',
            'your_occupation' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        EmploymentWithinLastFiveYears::where('id', $item_id)->update([
            'employment_w_l_f_y__name' => $request->name,
            'employment_w_l_f_y__address_of_employer' => $request->address_of_employer,
            'employment_w_l_f_y__your_occupation' => $request->your_occupation,
            'employment_w_l_f_y__from' => $request->from,
            'employment_w_l_f_y__to' => $request->to,
            'updated_at' => now(),
        ]);

        $item = EmploymentWithinLastFiveYears::find($item_id);
        $client_id = $item->client()->first()->id;

        return redirect()->route('clients->edit', $client_id)->withErrors([
            "employment_within_last_five_years_updated_successfully" => "Employment Within Last 5 Years Updated Successfully"
        ]);

    }

    public function delete(Request $request, $item_id)
    {

        $item = EmploymentWithinLastFiveYears::find($item_id);

        $data = [
            'item_id' => $item_id,
            'item' => $item
        ];

        return view('crm.pages.employment-within-last-five-years.delete', $data);

    }

    public function destroy(Request $request, $item_id)
    {
        $item = EmploymentWithinLastFiveYears::find($item_id);
        $client_id = $item->client()->first()->id;

        $client = Client::find($client_id);
        $client->employment_within_last_five_years()->detach($item_id);

        EmploymentWithinLastFiveYears::where('id', $item_id)->delete();

        return redirect()->route('clients->edit', $client_id)->withErrors([
            "employment_within_last_five_years_deleted_successfully" => "Employment Within Last 5 Years Deleted Successfully"
        ]);



    }
}
