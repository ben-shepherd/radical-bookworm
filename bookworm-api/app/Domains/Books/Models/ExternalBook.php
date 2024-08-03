<?php

declare(strict_types=1);

namespace App\Domains\Books\Models;

use App\Base\Model;

class ExternalBook extends Model
{
    protected $connection = 'mongodbExternal';
}
