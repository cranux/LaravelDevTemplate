<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Article\ArticleCreateRequest;
use App\Http\Requests\Article\ArticleUpdateRequest;
use App\Repositories\Interfaces\ArticleRepository;
use App\Validators\ArticleValidator;
use function auth;
use function flash;
use App\Models\Article;
use App\DataTables\ArticleDataTable;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * @var ArticleRepository
     */
    protected $repository;
    /**
     * @var ArticleValidator
     */
    protected $validator;

    /**
     * ArticleController constructor.
     * @param ArticleRepository $articleRepository
     * @param ArticleValidator $validator
     */
    public function __construct(ArticleRepository $articleRepository, ArticleValidator $validator)
    {
        $this->repository = $articleRepository;
        $this->validator = $validator;
    }

    /**
     * @param ArticleDataTable $dataTable
     * @return mixed
     */
    public function index(ArticleDataTable $dataTable)
    {
        return $dataTable->render('admin.article.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.article.create');
    }

    /**
     * @param ArticleCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ArticleCreateRequest $request)
    {
        $data = $request->all();

        $data['user_id'] = auth()->user()->id;

        $this->repository->create($data);

        flash('文章创建成功')->success()->overlay();

        return redirect()->route('admin.article.index');
    }

    /**
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Article $article)
    {
        return view('admin.article.show')
            ->with('article', $article);
    }

    /**
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Article $article)
    {
        return view('admin.article.edit')
            ->with('article', $article);
    }

    /**
     * @param ArticleUpdateRequest $request
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        $data = $request->all();

        $data['user_id'] = auth()->user()->id;

        $this->repository->update($data, $article->id);

        flash('文章信息修改成功')->success()->overlay();

        return redirect()->back();
    }

    /**
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article)
    {
        $this->repository->delete($article->id);

        flash('文章删除成功')->success()->overlay();

        return redirect()->back();
    }
}
