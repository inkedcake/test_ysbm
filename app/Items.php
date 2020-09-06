<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';
    protected $guarded = [];
    protected $rules = ['Fno' => 'digits_between:2,5', 'Lno' => 'numeric|min:2'];

}
