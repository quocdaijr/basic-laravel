<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Category\Repositories\Interfaces\CategoryRepositoryInterface;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Post\Constants\PostConstant;
use Modules\Post\Http\Requests\CreatePostRequest;
use Modules\Post\Http\Requests\UpdatePostRequest;
use Modules\Post\Repositories\Interfaces\PostRepositoryInterface;
use Modules\Tag\Repositories\Interfaces\TagRepositoryInterface;
use Storage;

class PostController extends CoreController
{

    public function __construct(
        protected PostRepositoryInterface     $postRepository,
        protected CategoryRepositoryInterface $categoryRepository,
        protected TagRepositoryInterface      $tagRepository
    )
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $posts = $this->postRepository->pagination(20);
        return view('post::index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories = $this->categoryRepository->all();
        return view('post::create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CreatePostRequest $request
     * @return Renderable
     */
    public function store(CreatePostRequest $request)
    {
        $data = [
            'name' => $request->name,
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->post('content'),
            'status' => PostConstant::getStatusByAction($request->action)
        ];

        $post = $this->postRepository->create($data);

        $post->categories()->sync($request->categories);

        $tags = $this->tagRepository->saveFromNames(array_unique($request->tags ?? []));
        $post->tags()->sync(array_unique($tags));

        $post->files()->syncWithPivotValues([$request->thumbnail], ['type' => PostConstant::POST_HAS_FILE_TYPE_THUMBNAIL]);

        return redirect()->route('post.index')->withToastSuccess('Create success');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('post::show');
    }


    /**
     * @param int $id
     * @return Application|Factory|View|void
     */
    public function edit(int $id)
    {
        if (!empty($post = $this->postRepository->find($id))) {
            $categories = $this->categoryRepository->all();
            if (!empty($post->files->toArray())) {
                foreach ($post->files->toArray() as $k => $v) {
                    if (!empty($v['pivot']['type']) && $v['pivot']['type'] == PostConstant::POST_HAS_FILE_TYPE_THUMBNAIL) {
                        $post->thumbnail['id'] = $v['id'];
                        $post->thumbnail['url'] = Storage::disk('public')->url($v['path']);
                    }
                }
            }
            return view('post::edit', compact('post', 'categories'));
        }
        abort(404);
    }

    /**
     * @param UpdatePostRequest $request
     * @param int $id
     * @return RedirectResponse|void
     */
    public function update(UpdatePostRequest $request, int $id)
    {
        if (!empty($oldPost = $this->postRepository->find($id))) {
            $data = [
                'name' => $request->name,
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->post('content'),
                'status' => PostConstant::getStatusByAction($request->action, $oldPost->status)
            ];

            $oldPost->categories()->sync($request->categories);

            $tags = $this->tagRepository->saveFromNames(array_unique($request->tags ?? []));

            $oldPost->tags()->sync(array_unique($tags));

            $oldPost->files()->syncWithPivotValues([$request->thumbnail], ['type' => PostConstant::POST_HAS_FILE_TYPE_THUMBNAIL]);

            $this->postRepository->update($id, $data);

            return redirect()->route('post.index')->with('success', 'Update success');
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
