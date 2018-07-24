<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction as Transaction;
use App\Models\TransactionDetail as TransactionDetail;
use App\Models\User as User;
use App\Models\Employee as Employee;
use App\Models\Route as Route;

class TransactionController extends Controller {

    public function all() {
        $data = Transaction::all();
        if ($data) {
            foreach ($data as $key => $value) {
                $user = User::where('id', '=', $value->user_id)->first();
                $employee = Employee::where('id', '=', $value->employee_id)->first();

                $data[$key]['user_name'] = ($user ? $user->name : '');
                $data[$key]['employee_name'] = ($employee ? $employee->name : '');
            }
            return $this->response(true, 200, 'Transaction retrieve successfully', $data);
        }
        return $this->response(false, 404, 'Transaction not available');
    }

    public function retrieve($data) {
        $data = Transaction::where('id', '=', $data)->first();
        return ($data) ? $this->response(true, 200, 'Transaction retrieve successfully', $data) : $this->response(false, 404, 'Transaction not found');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'user_id' => 'required|exists:user,id',
            'secret' => 'required|string|max:3',
        ]);
        $data = $request->json('data');
        $total = 0; $detail = array(); $valid = true;
        foreach($data as $key => $value) {
            $route = Route::where('id', '=', $data[$key]['id'])->first();
            if (!$route) {
                $valid = false;
                break;
            }
            $detail[$key]['route_id'] = $data[$key]['id'];
            $detail[$key]['amount'] = $data[$key]['cart'];
            $detail[$key]['price'] = $route->price;
            $total += $route->price;            
        }

        if ($valid) {
            $data = Transaction::create([
                'total' => $total,
                'user_id' => $request->json('user_id'),
                'secret' => $request->json('secret'),
                'employee_id' => null,
            ]);
                
            if ($data) {
                foreach($detail as $key => $value) {
                    $detail[$key]['transaction_id'] = $data->id;
                }    
                $detail = TransactionDetail::insert($detail);                
            }
            return $this->response(true, 200, 'Transaction successfully created', $data);      
        }        
        return $this->response(false, 404, 'Transaction or data not found');
    }

    public function update(Request $request, $data) {
        $data = Transaction::where('id', '=', $data)->first();
        if ($data) {
            $this->validate($request, [
                'total' => 'required|integer',
                'user_id' => 'required|string|max:11|exists:user,id',
                'employee_id' => 'required|string|max:11|exists:employee,id',
            ]);
            $data->update([
                'total' => $request->json('total'),
                'user_id' => $request->json('user_id'),
                'employee_id' => $request->json('employee_id'),
            ]);
            return $this->retrieve($data->id);
        }
        return $this->response(false, 404, 'Transaction or data not found');
    }

    public function paid(Request $request, $data) {
        $data = Transaction::where('id', '=', $data)->first();
        if ($data) {
            $data->update([
                'status' => '1',
            ]);

            $detail = TransactionDetail::where('transaction_id', '=', $data->id)->update(['status' => '1']);
            return $this->retrieve($data->id);
        }
        return $this->response(false, 404, 'Transaction or data not found');
    }

    public function unpaid(Request $request, $data) {
        $data = Transaction::where('id', '=', $data)->first();
        if ($data) {
            $data->update([
                'status' => '0',
            ]);

            $detail = TransactionDetail::where('transaction_id', '=', $data->id)->update(['status' => '0']);
            return $this->retrieve($data->id);
        }
        return $this->response(false, 404, 'Transaction or data not found');
    }

    public function delete($data) {
        $data = Transaction::find($data);
        if ($data) {
            $data->delete();
            return $this->response(true, 200, 'Transaction sucessfully deleted');
        }
        return $this->response(false, 404, 'Transaction not found');
    }
}
