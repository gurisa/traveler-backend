<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionDetail as TransactionDetail;

class TransactionDetailController extends Controller {

    public function all() {
        return ($data = TransactionDetail::all()) ? $this->response(true, 200, 'TransactionDetail retrieve successfully', $data) : $this->response(false, 404, 'TransactionDetail not available');
    }

    public function retrieve($data) {
        $data = TransactionDetail::where('id', '=', $data)->first();
        return ($data) ? $this->response(true, 200, 'TransactionDetail retrieve successfully', $data) : $this->response(false, 404, 'TransactionDetail not found');
    }

    public function store(Request $request) {
        if ($request->has(['transaction_id', 'amount', 'route_id'])) {
            $data = TransactionDetail::create([
                'transaction_id' => $request->json('transaction_id'),
                'amount' => $request->json('amount'),
                'route_id' => $request->json('route_id'),
            ]);
            return $this->response(true, 200, 'TransactionDetail successfully created', $data);
        }
        return $this->response(false, 404, 'Data not found');
    }

    public function update(Request $request, $data) {
        $data = TransactionDetail::where('id', '=', $data)->first();
        if ($data && $request->has(['transaction_id', 'amount', 'route_id'])) {
            $data->update([
                'transaction_id' => $request->json('transaction_id'),
                'amount' => $request->json('amount'),
                'route_id' => $request->json('route_id'),
            ]);
            return $this->retrieve($data->id);
        }
        return $this->response(false, 404, 'TransactionDetail or data not found');
    }

    public function delete($data) {
        $data = TransactionDetail::find($data);
        if ($data) {
            $data->delete();
            return $this->response(true, 200, 'TransactionDetail sucessfully deleted');
        }
        return $this->response(false, 404, 'TransactionDetail not found');
    }
}
