<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as User;
use App\Models\TransactionDetail as TransactionDetail;

class UserController extends Controller {

    public function all() {
        return ($User = User::all()) ? $this->response(true, 200, 'User retrieve successfully', $User) : $this->response(false, 404, 'User not available');
    }

    public function retrieve($User) {
        $User = User::where('id', '=', $User)->orWhere('email', '=', $User)->first();
        return ($User) ? $this->response(true, 200, 'User retrieve successfully', $User) : $this->response(false, 404, 'User not found');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'email' => 'required|email|max:190|unique:user',
            'password' => 'required|string|min:6|max:20',
            'name' => 'required|string|max:190',
        ]);

        $User = User::create([
            'email' => $request->json('email'),
            'password' => bcrypt($request->json('password')),
            'name' => $request->json('name'),
            'thumbnaill' => $request->has('thumbnaill') ? $request->json('thumbnaill') : null,
            'status' => '1',
            'authority' => 'user'
        ]);
        return $this->response(true, 200, 'User successfully created', $User);
    }

    public function update(Request $request, $User) {
        $User = User::where('id', '=', $User)->orWhere('email', '=', $User)->first();
        if ($User) {
            $this->validate($request, [
                'name' => 'required|string|max:190',
                'password' => 'required|string|min:6|max:20',                
            ]);
            $User->update([
                'name' => $request->json('name'),
                'password' => bcrypt($request->json('password')),
            ]);
            return $this->retrieve($User->id);
        }
        return $this->response(false, 404, 'User or data not found');
    }

    public function delete($User) {
        $User = User::find($User);
        if ($User) {
            $User->delete();
            return $this->response(true, 200, 'User sucessfully deleted');
        }
        return $this->response(false, 404, 'User not found');
    }

    public function transactions($User) {
        $User = User::where('id', '=', $User)->orWhere('email', '=', $User)->first();
        if ($User) {
            $data = Transaction::where('user_id', '=', $User->id)->get();
            return $this->response(true, 200, 'Transactions retrieve successfully', $data);
        }
        return $this->response(false, 404, 'User not found');
    }

    public function details($User) {
        $User = User::where('id', '=', $User)->orWhere('email', '=', $User)->first();
        if ($User) {
            $data = TransactionDetail::where('transaction.user_id', '=', $User->id)
                ->join('transaction', 'transaction.id', '=', 'transaction_detail.transaction_id')
                ->join('route', 'route.id', '=', 'transaction_detail.route_id')
                ->select('route.*')
                ->selectRaw('transaction_detail.amount AS detail_amount, transaction_detail.price AS detail_price, transaction_detail.id AS detail_id, transaction_detail.status AS detail_status, transaction_detail.transaction_id AS transaction_id')
                ->selectRaw('transaction.secret AS transaction_secret')               
                ->get();                
            if ($data) {
                foreach ($data as $key => $value) {
                    $data[$key]['ticket_token'] = md5($value->detail_id);
                }                
            }
            return $this->response(true, 200, 'Transaction details retrieve successfully', $data);
        }
        return $this->response(false, 404, 'User not found');
    }
}
