<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction as Transaction;
use App\Models\User as User;
use App\Models\Employee as Employee;

class TransactionController extends Controller {

    public function all() {
        $data = Transaction::all();
        if ($data) {
            foreach ($data as $key => $value) {
                $data[$key]['user_name'] = User::where('id', '=', $value->user_id)->first()->name;
                $data[$key]['employee_name'] = Employee::where('id', '=', $value->employee_id)->first()->name;
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
            'total' => 'required|integer',
            'user_id' => 'required|string|max:11|exists:user,id',
            'employee_id' => 'required|string|max:11|exists:employee,id',
        ]);
        $data = Transaction::create([
            'total' => $request->json('total'),
            'user_id' => $request->json('user_id'),
            'employee_id' => $request->json('employee_id'),
        ]);
        return $this->response(true, 200, 'Transaction successfully created', $data);
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
