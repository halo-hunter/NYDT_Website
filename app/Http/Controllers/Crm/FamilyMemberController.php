<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Crm\Client;
use App\Models\Crm\FamilyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FamilyMemberController extends Controller
{
    public function edit(Request $request, $client_id, $family_member_id) {
        if ($request->isMethod('get')) {

            $data = [
                'client_id' => $client_id,
                'family_member_id' => $family_member_id,
                'family_member' => FamilyMember::find($family_member_id)
            ];

            return view('crm.pages.family_members.update', $data);

        } elseif ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'relation' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)
                    ->withInput();
            }

            FamilyMember::where('id', $family_member_id)->update([
                'relation' => $request->relation,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);

            return redirect()->route('clients->edit', ['id' => $client_id])->withErrors([
                "family_member_edited_successfully" => "family member edited successfully"
            ]);

        }

    }

    public function delete(Request $request, $client_id, $family_member_id) {

        if ($request->isMethod('get')) {

            $data = [
                'client_id' => $client_id,
                'family_member_id' => $family_member_id,
                'family_member' => FamilyMember::find($family_member_id)
            ];

            return view('crm.pages.family_members.delete', $data);

        } elseif ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'family_member_id' => 'required'
            ]);

            if ($validator->fails()) {
                echo "family_member_id is missing";
                exit();
            }

            $client = Client::find($client_id);
            $client->family_members()->detach($family_member_id);

            FamilyMember::where('id', $family_member_id)->delete();

            return redirect()->route('clients->edit', ['id' => $client_id])->withErrors([
                "family_member_deleted_successfully" => "family member deleted successfully"
            ]);

        }

    }
}
