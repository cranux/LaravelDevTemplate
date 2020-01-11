<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ImagesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Image;
use App\Repositories\Interfaces\ImageRepository;
use App\Validators\ImageValidator;
use App\Http\Requests\Image\ImageCreateRequest;
use App\Http\Requests\Image\ImageUpdateRequest;

/**
 * Class ImagesController.
 *
 * @package namespace App\Http\Controllers;
 */
class ImagesController extends Controller
{
    /**
     * @var ImageRepository
     */
    protected $repository;

    /**
     * @var ImageValidator
     */
    protected $validator;

    /**
     * ImagesController constructor.
     *
     * @param ImageRepository $repository
     * @param ImageValidator $validator
     */
    public function __construct(ImageRepository $repository, ImageValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * @param ImagesDataTable $dataTable
     * @return mixed
     */
    public function index(ImagesDataTable $dataTable)
    {
        return $dataTable->render('admin.image.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.image.create');
    }

    /**
     * @param ImageCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ImageCreateRequest $request)
    {
        $data = $request->all();

        $data['user_id'] = auth()->user()->id;

        $this->repository->create($data);

        flash('图片信息创建成功')->success()->overlay();

        return redirect()->route('admin.image.index');
    }

    /**
     * @param Image $image
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Image $image)
    {
        return view('admin.image.show')
            ->with('image', $image);
    }

    /**
     * @param Image $image
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Image $image)
    {
        return view('admin.image.edit')
            ->with('image', $image);
    }

    /**
     * @param ImageUpdateRequest $request
     * @param Image $image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ImageUpdateRequest $request, Image $image)
    {
        $data = $request->all();

        $data['user_id'] = auth()->user()->id;

        $this->repository->update($data, $image->id);

        flash('图片信息修改成功')->success()->overlay();

        return redirect()->back();
    }

    /**
     * @param Image $image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Image $image)
    {
        $this->repository->delete($image->id);

        flash('图片删除成功')->success()->overlay();

        return redirect()->back();
    }

}
