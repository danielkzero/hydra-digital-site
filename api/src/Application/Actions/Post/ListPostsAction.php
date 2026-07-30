<?php

declare(strict_types=1);

namespace App\Application\Actions\Post;

use Psr\Http\Message\ResponseInterface as Response;

class ListPostsAction extends PostAction
{
    protected function action(): Response
    {
        $query = $this->request->getQueryParams();
        $limit = isset($query['limit']) ? max((int) $query['limit'], 1) : null;

        return $this->respondWithData($this->postRepository->findAll(true, $limit));
    }
}
