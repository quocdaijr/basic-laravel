<?php

namespace Modules\Category\Http\Controllers\Api;

use Modules\Category\Http\Requests\Api\CategoriesRequest;
use Modules\Category\Repositories\Interfaces\CategoryElasticsearchRepositoryInterface;
use Modules\Core\Constants\CoreConstant;
use Modules\Core\Http\Controllers\ApiController;

class CategoryController extends ApiController
{
    /**
     * @param CategoryElasticsearchRepositoryInterface $categoryElasticsearchRepository
     */
    public function __construct(
        protected CategoryElasticsearchRepositoryInterface $categoryElasticsearchRepository
    )
    {
    }

    /**
     * @param CategoriesRequest $request
     * @return array
     */
    public function categories(CategoriesRequest $request)
    {
        $posts = $this->categoryElasticsearchRepository->getFeCategories($request->all());
        $data = [];
        if (!empty($posts['data'])) {
            foreach ($posts['data'] as $post) {
                if (!empty($post['_source'])) {
                    $post['_source']['thumbnail'] = getUrlFile($post['_source']['thumbnail'] ?? '');
                    $post['_source']['cover'] = getUrlFile($post['_source']['cover'] ?? '');
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
    public function categoryBySlug($slug)
    {
        $post = $this->categoryElasticsearchRepository->findByAttributes(['slug' => $slug, 'status' => CoreConstant::STATUS_ACTIVE]);
        if (!empty($post['_source'])) {
            $post['_source']['thumbnail'] = getUrlFile($post['_source']['thumbnail'] ?? '');
            $post['_source']['cover'] = getUrlFile($post['_source']['cover'] ?? '');
            return $post['_source'];
        }
        abort(404);
    }
}
