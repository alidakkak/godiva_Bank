<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\password;

class SuperController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::all();
        $keys=["users"];
        $values=[$users];
        return  $this->returnData(200,$keys,$values);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
       $user= User::create([
            "name"=>$request->post("name"),
            "serial_number"=> $request->post("serial_number"),
            "type"=>$request->post("type"),
           "password"=>Hash::make($request->post("password")),
        ]);
        $keys=["user"];
        $values=[$user];
        return  $this->returnData(201,$keys,$values);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user=User::find($id);
        if (!$user){
            return $this->returnError(404,"user not found");
        }

        $user->update($request->post());
        $keys=["user"];
        $values=[$user];
        return  $this->returnData(202,$keys,$values);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::find($id);
        if (!$user){
            return $this->returnError(404,"user not found");
        }
        $user->delete();
        return  $this->returnSuccessMessage(204,"user deleted successfully");

    }
}
