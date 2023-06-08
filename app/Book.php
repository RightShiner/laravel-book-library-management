<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Book extends Model
{
    use Sortable;

    protected $fillable = [ 'title', 'author' , 'google_id','description','isbn','publisher','image','userOrder' ];

    public $sortable = ['id', 'title', 'author', 'isbn','userOrder'];


    //a book clone can only have one parent user
    public function user(){
       return $this->belongsTo(User::class);
    }
}
