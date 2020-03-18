<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table="users";
    protected $casts=array(
        'created_at' => 'datetime: d/m/Y', // Change your format
        'updated_at' => 'datetime: d/m/Y',
    );
}
