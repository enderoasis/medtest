<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Article;


class ArticleController extends BaseController
{
    // Общая выборка всех новостей
        public function index()
    {
        $articles = Article::all();
    
        return $this->endResponse($articles->toArray(), 'Все новости медицины успешно выведены.');
    }
    // Выборка конкретной новости по ее айди
    public function show($id)
    {
        $article = Article::find($id);

        if (is_null($article)) {
            return $this->sendError('Новость не найдена');
        }
        return $this->sendResponse($article->toArray(), 'Вот новость которую вы так искали');
    }
    // Сохранение новости в БД
    public function store(Request $request)
    {
        $input = $request->all();
        
        $article = Article::create($input);

        return $this->sendResponse($article->toArray(), 'Новость успешно добавлена.');

    }
    // Для изменение новости
    public function update(Request $request, Article $article)
    {
        $input = $request->all();

        $article->title = $input['title'];
        $article->category = $input['category'];
        $article->imgpath = $input['imgpath'];
        $article->content = $input['content'];

        $article->save();

        return $this->sendResponse($article->toArray(), 'Новость успешно отредактирована.');
    
    }

    public function delete(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return $this->sendResponse($product->toArray(), 'Вы удалили новость.');
        }
}

