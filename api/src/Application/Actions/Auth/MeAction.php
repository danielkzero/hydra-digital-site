<?php

declare(strict_types=1);

namespace App\Application\Actions\Auth;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class MeAction extends Action
{
    protected function action(): Response
    {
        return $this->respondWithData($this->request->getAttribute('admin'));
    }
}
