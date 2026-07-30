<?php

declare(strict_types=1);

namespace App\Domain\Post;

use App\Domain\DomainException\DomainRecordNotFoundException;

class PostNotFoundException extends DomainRecordNotFoundException
{
    public function __construct(string $identifier = '')
    {
        parent::__construct($identifier !== '' ? "Post {$identifier} not found." : 'Post not found.');
    }
}
