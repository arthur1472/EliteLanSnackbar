<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public const NIEUW = 1;

    public const IN_BEHANDELING = 2;

    public const KLAAR = 3;

    public const AFGEWEZEN = 4;

    protected $guarded = [];
}
