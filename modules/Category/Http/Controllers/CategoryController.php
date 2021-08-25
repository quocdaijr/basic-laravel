<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Modules\Category\Http\Requests\CreateCategoryRequest;
use Modules\Category\Http\Requests\UpdateCategoryRequest;
use Modules\Category\Repositories\Interfaces\CategoryRepositoryInterface;
use Modules\Core\Http\Controllers\CoreController;

class CategoryController extends CoreController
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
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
        $categories = $this->categoryRepository->pagination(2);
        return view('category::index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('category::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CreateCategoryRequest $request)
    {
        $this->categoryRepository->create($request->all());
        return redirect()->route('category.index')->withToastSuccess('Create success');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $category = $this->categoryRepository->one($id);
        return view('category::show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->one($id);
        return view('category::edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCategoryRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $this->categoryRepository->update($id, $request->all());
        return redirect()->route('category.index')->withToastSuccess('Update success');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->categoryRepository->delete($id);
        return redirect()->route('category.index')->withToastSuccess('Delete success');
    }
}
