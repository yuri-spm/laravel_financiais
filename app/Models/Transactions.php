<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $fillable = [
        'title',
        'description',
        'amount',
        'type',
        'transaction_date',
        'category_id',
        'account_id',
        'user_id',
        'is_recurring',
        'attachment'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function scopeExpense($query)
    {
        return $query->where('type', 'expense');
    }

    public function scopeIncome($query)
    {
        return $query->where('type', 'income');
    }

    public static function sumExpense()
    {
        return self::query()->expense()->sum('amount');
    }

    public static function sumIncome()
    {
        return self::query()->income()->sum('amount');
    }
}
