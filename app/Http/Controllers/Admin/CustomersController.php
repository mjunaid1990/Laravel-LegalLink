<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transactions;

class CustomersController extends Controller {

    public function index(Request $request) {

        $title = 'Customers';
        $q = $request->get('q') ? $request->get('q') : '';
        $sort = $request->get('sort') ? $request->get('sort') : '';

        $lists = User::when(!empty($q), function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%");
                    $query->orWhere('email', 'like', "%{$q}%");
                })
                ->when(!empty($sort), function ($query) use ($sort) {
                    if ($sort == 'asc') {
                        $query->orderBy('id', "asc");
                    } else if ($sort == 'desc') {
                        $query->orderBy('id', "desc");
                    }
                })
                ->when(empty($sort), function ($query) use ($sort) {
                    $query->orderBy('id', "desc");
                })
                ->where('role', 0)
                ->paginate(12);

        return view('admin/customers/index', compact('title', 'lists', 'q', 'sort'))->render();
    }
    
    public function view($id) {
        $title = 'Customer View';
        $model = User::where('id', $id)->first();
        $html = view('admin/customers/view', compact('title','model'))->render();
        $transactions = $this->customer_transaction_by_month($id);
        return response()->json(array('success' => true, 'html' => $html, 'series'=>$transactions));
    }
    
    protected function customer_transaction_by_month($id) {
        $months = get_months_arr();
        $series = [];
        if($months) {
            foreach ($months as $month=>$text) {
                $series['transactions'][] = $this->transactions($id, $month);
            }
        }
        return $series;
    }
    
    protected function transactions($id, $month) {
        $year = date('Y');
        $row = Transactions::selectRaw('count(id) as customer_count ')
                ->when(!empty($id), function ($query) use ($id) {
                    $query->where('added_from', $id );
                })
                ->whereRaw("DATE_FORMAT(created_at, '%m') = ?", [$month])
                ->whereRaw("DATE_FORMAT(created_at, '%Y') = ?", [$year])
                ->groupBy('added_from')
                ->first();
        if($row) {
            return round($row->customer_count);
        }
    }

    

}
