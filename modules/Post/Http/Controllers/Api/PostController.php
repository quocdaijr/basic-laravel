<?php

namespace Modules\Post\Http\Controllers\Api;

use Modules\Core\Http\Controllers\ApiController;
use Modules\Post\Http\Requests\Api\PostsRequest;
use Modules\Post\Repositories\Interfaces\PostElasticsearchRepositoryInterface;

class PostController extends ApiController
{
    /**
     * @param PostElasticsearchRepositoryInterface $postElasticsearchRepository
     */
    public function __construct(
        protected PostElasticsearchRepositoryInterface $postElasticsearchRepository
    )
    {
    }

    /**
     * @param PostsRequest $request
     * @return array
     */
    public function posts(PostsRequest $request)
    {
        $posts = $this->postElasticsearchRepository->getFePosts($request->all());
        $data = [];
        if (!empty($posts['data'])) {
            foreach ($posts['data'] as $post) {
                if (!empty($post['_source'])) {
                    $post['_source']['thumbnail'] = getUrlFile($post['_source']['thumbnail'] ?? '', false);
                    $post['_source']['cover'] = getUrlFile($post['_source']['cover'] ?? '', false);
                    if (!empty($post['_source']['categories'])) {
                        foreach ($post['_source']['categories'] as $key_category => $category) {
                            $post['_source']['categories'][$key_category]['thumbnail'] = getUrlFile($category['thumbnail'] ?? '', false);
                            $post['_source']['categories'][$key_category]['cover'] = getUrlFile($category['cover'] ?? '', false);
                        }
                    }
                    if (!empty($post['_source']['tags'])) {
                        foreach ($post['_source']['tags'] as $key_tag => $tag) {
                            $post['_source']['tags'][$key_tag]['thumbnail'] = getUrlFile($tag['thumbnail'] ?? '', false);
                            $post['_source']['tags'][$key_tag]['cover'] = getUrlFile($tag['cover'] ?? '', false);
                        }
                    }
                    $data[] = $post['_source'];
                }
            }
        }
        return [
            'data' => $data,
            'total' => $posts['total'] ?? 0
        ];
    }

    /**
     * @param $slug
     * @return mixed|void
     */
    public function postBySlug($slug)
    {
        $post = $this->postElasticsearchRepository->findByAttributes(['slug' => $slug]);
        if (!empty($post['_source'])) {
            $post['_source']['thumbnail'] = getUrlFile($post['_source']['thumbnail'] ?? '', false);
            $post['_source']['cover'] = getUrlFile($post['_source']['cover'] ?? '', false);
            if (!empty($post['_source']['categories'])) {
                foreach ($post['_source']['categories'] as $key_category => $category) {
                    $post['_source']['categories'][$key_category]['thumbnail'] = getUrlFile($category['thumbnail'] ?? '', false);
                    $post['_source']['categories'][$key_category]['cover'] = getUrlFile($category['cover'] ?? '', false);
                }
            }
            if (!empty($post['_source']['tags'])) {
                foreach ($post['_source']['tags'] as $key_tag => $tag) {
                    $post['_source']['tags'][$key_tag]['thumbnail'] = getUrlFile($tag['thumbnail'] ?? '', false);
                    $post['_source']['tags'][$key_tag]['cover'] = getUrlFile($tag['cover'] ?? '', false);
                }
            }
            return $post['_source'];
        }
        abort(404);
    }
}
