<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transportation as Transportation;
use App\Models\Transaction as Transaction;

class ReportController extends Controller {

    public function income() {
        $data = Transaction::all();
        if ($data) {
            return $this->response(true, 200, 'Transaction retrieve successfully', $data);
        }
        return $this->response(false, 404, 'Transaction not available');
    }

    public function inventory() {
        $data['total'] = Transportation::selectRaw(" 
                (SELECT COUNT(*) FROM `transportation` WHERE type='bus') AS bus, 
                (SELECT COUNT(*) FROM `transportation` WHERE type='plane') AS plane,
                (SELECT COUNT(*) FROM `transportation` WHERE type='train') AS train,
                (SELECT COUNT(*) FROM `transportation` WHERE type='car') AS car
            ")->first();
        $data['active'] = Transportation::selectRaw(" 
            (SELECT COUNT(*) FROM `transportation` WHERE type='bus' AND status='1') AS bus, 
            (SELECT COUNT(*) FROM `transportation` WHERE type='plane' AND status='1') AS plane,
            (SELECT COUNT(*) FROM `transportation` WHERE type='train' AND status='1') AS train,
            (SELECT COUNT(*) FROM `transportation` WHERE type='car' AND status='1') AS car
        ")->first();
        $data['inactive'] = Transportation::selectRaw(" 
            (SELECT COUNT(*) FROM `transportation` WHERE type='bus' AND status='0') AS bus, 
            (SELECT COUNT(*) FROM `transportation` WHERE type='plane' AND status='0') AS plane,
            (SELECT COUNT(*) FROM `transportation` WHERE type='train' AND status='0') AS train,
            (SELECT COUNT(*) FROM `transportation` WHERE type='car' AND status='0') AS car
        ")->first();

        return ($data) ? $this->response(true, 200, 'Transportation retrieve successfully', $data) : $this->response(false, 404, 'Transportation or data not found');
    }

}
