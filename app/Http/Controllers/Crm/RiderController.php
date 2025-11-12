<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Crm\Client;
use App\Models\Crm\Relation;
use App\Models\Crm\Rider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RiderController extends Controller
{
    public function index(Request $request)
    {
        $clientId = $request->clientId;

        $client = Client::find($clientId);

        $client_riders = $client->riders()->get()->toJson();

        return $client_riders;
    }

    public function store(Request $request)
    {

        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $email = $request->email;
        $phone = $request->phone;
        $client_id = $request->client_id;

        $client = Client::find($client_id);

        $client_riders = $client->riders()->get();

        if (collect($client_riders)->where('firstname', $firstname)->where('lastname', $lastname)->count() == 0) {

            $insert_get_id = Rider::insertGetId([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'phone' => $phone,
                'created_at' => Carbon::now()
            ]);

            if ($insert_get_id) {

                $client->riders()->attach($insert_get_id);

                GenericController::twilio_send_sms($client_id, null, null, $phone, "");

                echo $insert_get_id;

            }

        } else {

            echo 1;

        }

    }

    public function edit(Request $request, $rider_id)
    {
        $rider = Rider::find($rider_id);

        $relation = $rider->relations()->first();

        $data = [
          'relation' => $relation,
          'rider' => $rider,
        ];

        return view('crm.pages.riders.update', $data);
    }

    public function update(Request $request, $rider_id)
    {
        $validator = Validator::make($request->all(), [
            'relation' => 'required',
            'firstname' => 'required',
            'lastname' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        Relation::where('id', $request->relation_id)->update([
            'name' => $request->relation
        ]);

        Rider::where('id', $rider_id)->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname
        ]);

        $rider = Rider::find($rider_id);

        $client_id = $rider->client()->first()->id;

        return redirect()->route('clients->edit', $client_id)->withErrors([
            "rider_updated_successfully" => "rider updated successfully"
        ]);
    }

    public function delete(Request $request, $rider_id)
    {
        $rider = Rider::find($rider_id);

        $relation = $rider->relations()->first();

        $data = [
            'relation' => $relation,
            'rider' => $rider,
        ];

        return view('crm.pages.riders.delete', $data);
    }

    public function destroy(Request $request, $rider_id)
    {
        $rider = Rider::find($rider_id);

        $relation_id = $rider->relations()->first()->id;
        $client_id = $rider->client()->first()->id;

        $relation = Relation::find($relation_id);
        $client = Client::find($client_id);

        $client->riders()->detach($rider_id);
        $client->relations()->detach($relation_id);

        $relation->riders()->detach($rider_id);

        Rider::where('id', $rider_id)->delete();

        return redirect()->route('clients->edit', $client_id)->withErrors([
            "rider_deleted_successfully" => "rider deleted successfully"
        ]);

    }

}
