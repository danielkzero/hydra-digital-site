<?php

declare(strict_types=1);

namespace App\Application\Actions\Post;

use Psr\Http\Message\ResponseInterface as Response;

class ViewPostAction extends PostAction
{
    protected function action(): Response
    {
        $slug = (string) $this->resolveArg('slug');

        return $this->respondWithData($this->postRepository->findBySlug($slug, true));
    }
}
