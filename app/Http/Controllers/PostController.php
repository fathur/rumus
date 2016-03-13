<?php

namespace App\Http\Controllers;

use App\Models\Taxonomy;
use App\Repositories\Parse;
use App\Models\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class PostController extends Controller
{
    /**
     * List all posts
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function index()
    {
        $posts = Post::take(10)->get();

        return view('post.index', compact('posts'));
    }

    /**
     * View single post
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function show($slug)
    {
        $taxonomy = Taxonomy::findBySlug($slug);


        // Pertama check apakah slug ada di category
        if($taxonomy) {
            /** @var Taxonomy $taxonomy */
            return $this->showAsCategoryList($slug, $taxonomy);
        }

        // Kemudian check jika tidak ada baru cek di post
        else {
            return $this->showAsSinglePost($slug);
        }

    }

    public function create()
    {
        $this->middleware('auth');

        return view('post.create');
    }

    public function store(Request $request)
    {
        $this->middleware('auth');

        $post = Post::create([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
        ]);

        return redirect()->route('post.slug', $post->slug);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function edit($id)
    {
        $this->middleware('auth');

        $post = Post::find($id);

        if(is_null($post))
            abort(404);

        return view('post.edit', compact('post'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function update($id, Request $request)
    {
        $this->middleware('auth');

        $post = Post::find($id);

        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->save();

        return redirect()->route('post.slug', $post->slug);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function preview(Request $request)
    {
        $title = $request->get('title');
        $content = $request->get('content');

        $content = Parse::render($content);

        return view('post.preview', compact('content','title'));

    }

    /**
     * @param $slug
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    private function showAsCategoryList($slug, Taxonomy $taxonomy)
    {
        return view('taxonomy.show')
            ->with('taxonomy', $taxonomy);
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    private function showAsSinglePost($slug)
    {
        $post = Post::findBySlug($slug);

        if(is_null($post))
            abort(404);

        return view('post.show', compact('post'));
    }
}
