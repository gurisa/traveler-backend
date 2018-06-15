<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionDetail as TransactionDetail;

class TransactionDetailController extends Controller {

    public function all() {
        return ($data = TransactionDetail::all()) ? $this->response(true, 200, 'Transaction Detail retrieve successfully', $data) : $this->response(false, 404, 'TransactionDetail not available');
    }

    public function retrieve($data) {
        $data = TransactionDetail::where('id', '=', $data)->first();
        return ($data) ? $this->response(true, 200, 'Transaction Detail retrieve successfully', $data) : $this->response(false, 404, 'TransactionDetail not found');
    }

    public function store(Request $request) {
        $this->validate($request, [                
            'transaction_id' => 'required|string|max:11|exists:transaction,id',
            'route_id' => 'required|string|max:11|exists:route,id',
            'amount' => 'required|integer|max:190',
            'price' => 'required|integer',
        ]);
        $data = TransactionDetail::create([
            'transaction_id' => $request->json('transaction_id'),                
            'route_id' => $request->json('route_id'),
            'amount' => $request->json('amount'),
            'price' => $request->json('amount'),
        ]);
        return $this->response(true, 200, 'Transaction Detail successfully created', $data);
    }

    public function update(Request $request, $data) {
        $data = TransactionDetail::where('id', '=', $data)->first();
        if ($data) {
            $this->validate($request, [                
                'transaction_id' => 'required|string|max:11|exists:transaction,id',
                'route_id' => 'required|string|max:11|exists:route,id',
                'amount' => 'required|integer|max:190',
                'price' => 'required|integer',
            ]);
            $data->update([
                'transaction_id' => $request->json('transaction_id'),                
                'route_id' => $request->json('route_id'),
                'amount' => $request->json('amount'),
                'price' => $request->json('amount'),
            ]);
            return $this->retrieve($data->id);
        }
        return $this->response(false, 404, 'Transaction Detail or data not found');
    }

    public function delete($data) {
        $data = TransactionDetail::find($data);
        if ($data) {
            $data->delete();
            return $this->response(true, 200, 'Transaction Detail sucessfully deleted');
        }
        return $this->response(false, 404, 'Transaction Detail not found');
    }
}
