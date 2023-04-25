<?php

namespace App\DTO;

use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;

class BaseDTO implements Contracts\DTOInterface
{
    public function toArray(): array
    {
        return call_user_func('get_object_vars', $this);
    }
}
