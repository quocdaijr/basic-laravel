<?php

namespace Modules\Tag\Http\Controllers\Api;

use Modules\Core\Constants\CoreConstant;
use Modules\Core\Http\Controllers\ApiController;
use Modules\Tag\Http\Requests\Api\TagsRequest;
use Modules\Tag\Repositories\Interfaces\TagElasticsearchRepositoryInterface;

class TagController extends ApiController
{
    /**
     * @param TagElasticsearchRepositoryInterface $tagElasticsearchRepository
     */
    public function __construct(
        protected TagElasticsearchRepositoryInterface $tagElasticsearchRepository
    )
    {
    }

    /**
     * @param TagsRequest $request
     * @return array
     */
    public function tags(TagsRequest $request)
    {
        $posts = $this->tagElasticsearchRepository->getFeTags($request->all());
        $data = [];
        if (!empty($posts['data'])) {
            foreach ($posts['data'] as $post) {
                if (!empty($post['_source'])) {
                    $post['_source']['thumbnail'] = getUrlFile($post['_source']['thumbnail'] ?? '', false);
                    $post['_source']['cover'] = getUrlFile($post['_source']['cover'] ?? '', false);
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
    public function tagBySlug($slug)
    {
        $post = $this->tagElasticsearchRepository->findByAttributes(['slug' => $slug, 'status' => CoreConstant::STATUS_ACTIVE]) ;
        if (!empty($post['_source'])) {
            $post['_source']['thumbnail'] = getUrlFile($post['_source']['thumbnail'] ?? '', false);
            $post['_source']['cover'] = getUrlFile($post['_source']['cover'] ?? '', false);
            return $post['_source'];
        }
        abort(404);
    }
}

