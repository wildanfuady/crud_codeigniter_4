<?php namespace App\Models;

use CodeIgniter\Model;

class WelcomeModel extends Model
{
    protected $table = 'users';

    public function get()
    {
        return "Contoh";
    }
}