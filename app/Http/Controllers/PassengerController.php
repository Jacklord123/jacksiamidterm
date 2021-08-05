<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Exception;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function show(Passenger $passenger) {
        return response()->json($passenger,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $applicants = Passenger::where('name','like',"%$request->key%")
            ->orWhere('age','like',"%$request->key%")->get();

        return response()->json($passengers, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'string|required',
            'age' => 'string|required',
            'address' => 'string|required',
            'contact' => 'string|required',
        ]);

        try {
            $passenger = Passenger::create($request->all());
            return response()->json($passenger, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Passenger $passenger) {
        try {
            $passenger->update($request->all());
            return response()->json($passenger, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Passenger $passenger) {
        $passenger->delete();
        return response()->json(['message'=>'passenger deleted.'],202);
    }

    public function index() {
        $passengers = Passenger::orderBy('name')->get();
        return response()->json($passengers, 200);
    }
}
