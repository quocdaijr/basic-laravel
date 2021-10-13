<?php

namespace Modules\File\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Core\Constants\CoreConstant;
use Modules\Core\Http\Controllers\CoreController;
use Modules\File\Http\Requests\CreateFileRequest;
use Modules\File\Http\Requests\UpdateFileRequest;
use Modules\File\Repositories\Interfaces\FileRepositoryInterface;
use Modules\File\Services\FileService;
use function React\Promise\all;

class FileController extends CoreController
{
    public function __construct(
        protected FileRepositoryInterface $fileRepository,
        protected FileService             $fileService
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
        return view('file::index');
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateFileRequest $request
     * @return JsonResponse
     */
    public function store(CreateFileRequest $request)
    {
        $data = $this->fileService->store($request->file('file'));
        if ($data !== null) {
            $layout = $request->get('layout');
            $response = match ($layout) {
                'ckeditor' => [
                    'id' => $data->id,
                    'fileName' => $data->name,
                    'uploaded' => 1,
                    'url' => getUrlFile($data->path)
                ],
                default => [
                    'id' => $data->id,
                    'fileName' => $data->name,
                    'url' => getUrlFile($data->path)
                ],
            };
            return response()->json($response);
        }
        return response()->json([
            'error' => 'Upload Failed'
        ], 400);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateFileRequest $request
     * @param int $id
     * @return RedirectResponse|JsonResponse|void
     */
    public function update(UpdateFileRequest $request, int $id)
    {
        if ($this->fileRepository->find($id)) {
            $data = [
                'title' => $request->title,
                'description' => $request->description
            ];
            if (!empty($request->name))
                $data['name'] = $request->name;
            if (!empty($request->status))
                $data['status'] = $request->status;

            $this->fileRepository->update($id, $data);
            return response()->json(['success' => true]);
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return JsonResponse|RedirectResponse|void
     */
    public function destroy($id)
    {
        if ($this->fileRepository->find($id)) {
            $deleted = $this->fileService->delete($id);
            return response()->json(['success' => $deleted]);
        }
        abort(404);
    }

    public function files(Request $request)
    {
        $page = $request->page ?? 1;
        $perPage = $request->perPage ?? 20;
        $params = [];
        if (!empty($request->txt)) {
            $params[] = ['name', 'like', "%$request->txt%"];
        }
        if (!empty($request->status)) {
            $params[] = ['status', $request->status];
        }
        if (!empty($request->type)) {
            $params[] = ['type', $request->type];
        }
        return response()->json($this->fileRepository->search($params, ($page - 1) * $perPage, $perPage, 'id', 'desc'));
    }
}
