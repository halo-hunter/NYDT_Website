<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Crm\CaseModel;
use App\Models\Crm\EntryDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EntryDateController extends Controller
{
    public function edit(Request $request, $entry_date_id)
    {

        $entry_date = EntryDate::find($entry_date_id);

        $data = [
            'entry_date_id' => $entry_date_id,
            'entry_date' => $entry_date
        ];

        return view('crm.pages.entry-date.update', $data);

    }

    public function update(Request $request, $entry_date_id)
    {

        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'place' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        EntryDate::where('id', $entry_date_id)->update([
            'date' => $request->date,
            'place' => $request->place
        ]);

        $entry_date = EntryDate::find($entry_date_id);
        $case_id = $entry_date->case()->first()->id;

        return redirect()->route('cases->edit', $case_id)->withErrors([
            "entry_date_updated_successfully" => "Entry Date Updated Successfully"
        ]);

    }

    public function delete(Request $request, $entry_date_id)
    {

        $entry_date = EntryDate::find($entry_date_id);

        $data = [
            'entry_date_id' => $entry_date_id,
            'entry_date' => $entry_date
        ];

        return view('crm.pages.entry-date.delete', $data);

    }

    public function destroy(Request $request, $entry_date_id)
    {
        $entry_date = EntryDate::find($entry_date_id);
        $case_id = $entry_date->case()->first()->id;

        $case = CaseModel::find($case_id);
        $case->entry_dates()->detach($entry_date_id);

        EntryDate::where('id', $entry_date_id)->delete();

        return redirect()->route('cases->edit', $case_id)->withErrors([
            "entry_date_deleted_successfully" => "Entry Date Deleted Successfully"
        ]);



    }
}
