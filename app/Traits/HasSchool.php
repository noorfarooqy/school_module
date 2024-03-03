<?php

namespace Noorfarooqy\SchoolModule\Traits;

use Noorfarooqy\SchoolModule\DataModels\Schools;

trait HasSchool
{
    public function hasSchool()
    {
        return $this->hasOne(Schools::class, 'owner');
    }
}
