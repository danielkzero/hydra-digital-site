<?php

declare(strict_types=1);

namespace App\Application\Actions\Post;

use Psr\Http\Message\ResponseInterface as Response;

class UpdatePostAction extends PostAction
{
    protected function action(): Response
    {
        $id = (int) $this->resolveArg('id');
        $post = $this->postRepository->update($id, $this->getValidatedPayload(true));

        return $this->respondWithData($post);
    }
}
