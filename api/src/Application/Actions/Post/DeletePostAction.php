<?php

declare(strict_types=1);

namespace App\Application\Actions\Post;

use Psr\Http\Message\ResponseInterface as Response;

class DeletePostAction extends PostAction
{
    protected function action(): Response
    {
        $id = (int) $this->resolveArg('id');
        $this->postRepository->delete($id);

        return $this->respondWithData(['deleted' => true]);
    }
}
