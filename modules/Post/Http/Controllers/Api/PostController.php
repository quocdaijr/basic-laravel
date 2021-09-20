<?php

namespace Modules\Post\Http\Controllers\Api;

use Modules\Core\Http\Controllers\ApiController;
use Modules\Post\Http\Requests\Api\PostsRequest;
use Modules\Post\Repositories\Interfaces\PostElasticsearchRepositoryInterface;

class PostController extends ApiController
{
    public function __construct(
        protected PostElasticsearchRepositoryInterface $postElasticsearchRepository
    )
    {
    }

    public function posts(PostsRequest $request)
    {
        $posts = $this->postElasticsearchRepository->getFePosts($request->all());
        $data = [];
        if (!empty($posts['data'])) {
            foreach ($posts['data'] as $post) {
                if (!empty($post['_source'])) {
                    $post['_source']['thumbnail'] = getUrlFile($post['_source']['thumbnail'] ?? '');
                    $data[] = $post['_source'];
                }
            }
        }
        return [
            'data' => $data,
            'total' => $posts['total'] ?? 0
        ];
    }

    public function post($id)
    {
        $post = $this->postElasticsearchRepository->findByAttributes(['id' => $id]);
        if (!empty($data = $post['_source'])) {
            $data['thumbnail'] = getUrlFile($data['thumbnail'] ?? '');
        }
        return $data ?? [];
    }
}
