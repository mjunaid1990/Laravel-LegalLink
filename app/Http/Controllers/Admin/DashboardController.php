<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transactions;
use App\Models\Agreements;
use App\Models\AgreementsPurchased;
use App\Models\User;
use Auth;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $title = 'Dashboard';
        $total_agreements = Agreements::count();
        $today_agreements = $this->today_agreements();
        $total_sales = Transactions::sum('amount');
        $today_sales = $this->today_sales();
        $topselling = $this->top_selling();
        $total_customers = User::where('role', 0)->count();
                
        return view('admin/index', compact('title', 'total_agreements', 'total_sales', 'today_agreements', 'today_sales', 'topselling', 'total_customers'));
    }
    
    public function sales_by_month() {
        $months = get_months_arr();
        $series = [];
        if($months) {
            foreach ($months as $month=>$text) {
                $series['transactions'][] = $this->transactions_by_month($month);
            }
        }
        return response()->json(array('success' => true, 'series'=>$series));
    }
    
    protected function transactions_by_month($month) {
        $year = date('Y');
        $row = Transactions::selectRaw('count(id) as customer_count ')
                ->whereRaw("DATE_FORMAT(created_at, '%m') = ?", [$month])
                ->whereRaw("DATE_FORMAT(created_at, '%Y') = ?", [$year])
                ->first();
        if($row) {
            return round($row->customer_count);
        }
    }
    
    protected function today_sales() {
        $year = date('Y');
        $month = date('m');
        $row = Transactions::selectRaw('sum(amount) as total ')
                ->whereRaw("DATE_FORMAT(created_at, '%m') = ?", [$month])
                ->whereRaw("DATE_FORMAT(created_at, '%Y') = ?", [$year])
                ->first();
        if($row) {
            return $row->total;
        }
    }
    
    protected function today_agreements() {
        $year = date('Y');
        $month = date('m');
        $row = Agreements::selectRaw('count(id) as total ')
                ->whereRaw("DATE_FORMAT(created_at, '%m') = ?", [$month])
                ->whereRaw("DATE_FORMAT(created_at, '%Y') = ?", [$year])
                ->first();
        if($row) {
            return $row->total;
        }
    }
    
    protected function top_selling() {
        $rows = AgreementsPurchased::selectRaw('*, count(agreement_id) as max')
                ->groupBy('agreement_id')->orderBy('max', 'asc')->limit(5)->get();
        if($rows) {
            return $rows;
        }
    }
    
    
}
