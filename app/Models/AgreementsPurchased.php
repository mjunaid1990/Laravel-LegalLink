<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transactions;
use Auth;
class AgreementsPurchased extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'added_from',
        'agreement_id',
        'transaction_id',
        'txn_id',
        'status'
    ];
    
    public function scopeAddedFrom($query) {
        return $query->where('added_from', Auth::user()->id);
    }
    
    public function agreement() {
        return $this->hasOne(Agreements::class, 'id', 'agreement_id');
    }
    
    public function user() {
        return $this->hasOne(User::class, 'id', 'added_from');
    }
    
    public function totalSales($agreement_id) {
        $rows = self::where('agreement_id', $agreement_id)->get();
        $data = [];
        if($rows) {
            foreach ($rows as $row) {
                $trans = Transactions::where('txn_id', $row->txn_id)->first();
                if($trans) {
                    $data[] = $trans->amount;
                }
            }
        }
        if($data) {
            return array_sum($data);
        }
    }
    
}
