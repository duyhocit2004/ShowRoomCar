<?php

namespace App\Repositories;

use App\Models\TestDriverRequestModel;
use Illuminate\Http\Request;

class ListFormRegisterRepository
{
    public function ListAccountRegister($name, $email, $status, $perPage = 10)
    {

        $query = TestDriverRequestModel::query();

        $query->with('TestDriverMethod');

        if (!empty($name)) {
            $query->where('name', 'like', "%{$name}%");
        }

        if (!empty($email)) {
            $query->where('email', 'like', "%{$email}%");
        }

        if ($status !== '' && $status !== null) {
            $query->where('status', $status);
        }

        

        return $query->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function UpdateAccountRegister($id,$Request) {
        $Request = TestDriverRequestModel::find($id);
        
        $Request->update([
            'name'=> $Request->name,
            'phone'=> $Request->phone,
            'email'=> $Request->email,
            'car'=> $Request->car,
            'status'=> $Request->status,
            'testDriveMethod_id'=>$Request->testDriveMethod_id,
            'dateTest'=> $Request-> dateTest,
            'note'=> $Request->note
        ]);

        return $Request;
    }

    public function SoftDeleteAccountRegister(Request $Request) {}

    public function DetailAccountRegister($id) {

        $query = TestDriverRequestModel::findOrFail($id);
        
        $query->with('TestDriverMethod');

         return $query->first();
    }
}
