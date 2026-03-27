<?php
// namespace App\Models;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Ticket extends Model
// {
//     use HasFactory;
//     protected $fillable = ['title', 'description', 'status', 'priority'];
// }



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'user_id',        // ← yeh naya add kiya
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}