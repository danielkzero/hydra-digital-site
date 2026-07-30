<?php

declare(strict_types=1);

namespace App\Application\Actions\Post;

use Psr\Http\Message\ResponseInterface as Response;

class ListAdminPostsAction extends PostAction
{
    protected function action(): Response
    {
        return $this->respondWithData($this->postRepository->findAll(false));
    }
}
