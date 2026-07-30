<?php

declare(strict_types=1);

namespace App\Domain\Admin;

use App\Domain\DomainException\DomainRecordNotFoundException;

class AdminNotFoundException extends DomainRecordNotFoundException
{
    public function __construct(string $identifier = '')
    {
        parent::__construct($identifier !== '' ? "Admin {$identifier} not found." : 'Admin not found.');
    }
}
