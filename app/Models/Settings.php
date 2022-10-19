<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = [
            'system_name',
            'system_title',
            'email',
            'phone',
            'address',
            'system_description',
            'favicon',
            'logo',
            'facebook',
            'youtube',
            'twitter',
            'linkedin',
            'side_bg_color',
            'side_text_color',
            'nav_bg_color',
            'nav_text_color',
            'timezone',
            'currency_symbol',
            'app_url',
            'db_host',
            'db_port',
            'db_name',
            'db_username',
            'db_password',
    ];


}
