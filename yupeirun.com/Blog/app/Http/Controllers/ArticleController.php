<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Markdown;
use Validator;
use App\Article;
use Auth;
use App\Tag;
use Redirect;
use App\User;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct()
{
    //限登陆用户操作，且只能操作以下方法
    $this->middleware('auth',['only'=>['create', 'store', 'edit', 'update', 'destroy']]);
	$this->middleware('canOperation',['only'=>'edit', 'update', 'destroy']);
}
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('articles.create');
    }
	
	public function preview(Request $request) {
    return Markdown::parse($request->input('content'));
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
        'title'   => 'required|max:100',
        'content' => 'required',
        'tags'    => ['required', 'regex:/^\w+$|^(\w+,)+\w+$/'],
        ];
      //数据校验
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $article = Article::create($request->only('title', 'content'));
            $article->user_id = Auth::id();
            $resolved_content = Markdown::parse($request->input('content'));
            $article->resolved_content = $resolved_content;
            $tags = explode(',', $request->input('tags'));
              //添加 summary
          if (str_contains($resolved_content, '<p>')) {
                $start = strpos($resolved_content, '<p>');
                $length = strpos($resolved_content, '</p>') - $start - 4;
                $article->summary = substr($resolved_content, $start + 3, $length);
            } else if (str_contains($resolved_content, '</h')) {
                $start = strpos($resolved_content, '<h>');
                $length = strpos($resolved_content, '</h>') - $start - 4;
                $article->summary = substr($resolved_content, $start + 4, $length);
            }
            $article->save();
          //处理标签
            foreach ($tags as $tagName) {
                $tag = Tag::whereName($tagName)->first();
                if (!$tag) {
                    $tag = Tag::create(array('name' => $tagName));
                }
                $tag->count++;
                $article->tags()->save($tag);
            }
            return Redirect::route('article.show', $article->id);
        } else {
            return Redirect::route('article.create')->withInput()->withErrors($validator);
        }
    }
    //展示文章详情
    public function show($id)
    {
		
        return view('articles.show')->with('article', Article::find($id));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $article = Article::with('tags')->find($id);
        $tags = '';
        for ($i = 0, $len = count($article->tags); $i < $len; $i++) {
            $tags .= $article->tags[$i]->name . ($i == $len - 1 ? '' : ',');
        }
        $article->tags = $tags;
        return view('articles.edit')->with('article', $article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title'   => 'required|max:100',
            'content' => 'required',
            'tags'    => ['required', 'regex:/^\w+$|^(\w+,)+\w+$/'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $article = Article::with('tags')->find($id);
            $article->update($request->only('title', 'content'));
          //解析文章内容  
          $resolved_content = Markdown::parse($request->input('content'));
            $article->resolved_content = $resolved_content;
            $tags = array_unique(explode(',', $request->input('tags')));
            if (str_contains($resolved_content, '<p>')) {
                $start = strpos($resolved_content, '<p>');
                $length = strpos($resolved_content, '</p>') - $start - 3;
                $article->summary = substr($resolved_content, $start + 3, $length);
            } elseif (str_contains($resolved_content, '</h')) {
                $start = strpos($resolved_content, '<h');
                $length = strpos($resolved_content, '</h') - $start - 4;
                $article->summary = substr($resolved_content, $start + 4, $length);
            }
            $article->save();
            foreach ($article->tags as $tag) {
                if (($index = array_search($tag->name, $tags)) !== false) {
                    unset($tags[$index]);
                } else {
                    $tag->count--;
                    $tag->save();
                    $article->tags()->detach($tag->id);
                }
            }
            foreach ($tags as $tagName) {
                $tag = Tag::whereName($tagName)->first();
                if (!$tag) {
                    $tag = Tag::create(['name' => $tagName]);
                }
                $tag->count++;
                $article->tags()->save($tag);
            }
            return Redirect::route('article.show', $article->id);
        } else {
            return Redirect::route('article.edit', $id)->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
    foreach ($article->tags as $tag) {
        $tag->count--;
        $tag->save();
        $article->tags()->detach($tag->id);
    }
    $article->delete();
    return Redirect::to('users/home');
    }
}
