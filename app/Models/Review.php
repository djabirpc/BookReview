<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function book(){
        return $this->belongsTo(Book::class);
    }

    // protected static function booted1(){
    //     static::updated(fn(Review $review) => cache()->forget('book:'.$review->book_id));
    //     static::deleted(fn(Review $review) => cache()->forget('book:'.$review->book_id));
    // }

    protected static function booted(): void
    {
        static::updated(function (Review $review){
            cache()->forget('book:'.$review->book_id);
        });

        static::deleted(function (Review $review){
            cache()->forget('book:'.$review->book_id);
        });
    }
}
