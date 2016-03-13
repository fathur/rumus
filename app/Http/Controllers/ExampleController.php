<?php

namespace App\Http\Controllers;

use App\Models\Example;
use App\Models\Post;
use App\Repositories\Parse;
use Illuminate\Http\Request;

use App\Http\Requests;

class ExampleController extends Controller
{
    public function index($post)
    {

    }

    /**
     * @param $post
     * @param $example
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function show($post, $example)
    {
        $example = Example::find($example);

        return view('example.show', compact('example'));
    }

    /**
     * @param $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function create($post)
    {
        $this->middleware('auth');

        $post = Post::with('examples')->find($post);

        return view('example.create', compact('post'));
    }

    /**
     * @param $post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function store($post, Request $request)
    {
        $this->middleware('auth');

        $post = Post::find($post);

        $example = $post->examples()->create([
            'question' => $request->get('question'),
            'answer' => $request->get('answer'),
        ]);

        return redirect()->route('post.example.show', [$post->id, $example->id]);
    }

    /**
     * @param $post
     * @param $example
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function edit($post, $example)
    {
        $this->middleware('auth');

        $example = Example::find($example);

        return view('example.edit', compact('example'));
    }

    /**
     * @param $post
     * @param $example
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function update($post, $example, Request $request)
    {
        $this->middleware('auth');

        $example = Example::find($example);
        //$redirect = ($request->has('redirect') AND $request->get('redirect') == true) ? true : false;

        $example->question = $request->get('question');
        $example->answer = $request->get('answer');
        $example->save();

        //if($redirect)
        return redirect()->route('post.example.show', [$post, $example->id]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function preview(Request $request)
    {
        $question = $request->get('question');
        $answer = $request->get('answer');

        $question = Parse::render($question);
        $answer = Parse::render($answer);

        return view('example.preview', compact('question','answer'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function postPreviewAjax(Request $request)
    {
        $answer = $request->get('answer');

        $answer = Parse::render($answer);

        return view('example.ajax-preview', compact('answer'));
    }

    /**
     * @param Request $request
     * @return $this
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getAnswer(Request $request)
    {
        $exampleId = $request->get('example');

        $example = Example::find($exampleId);

        return view('example.answer',compact('example'))
            ->with('id', $exampleId);
    }

    public function putAnswer(Request $request)
    {
        $this->middleware('auth');

        $exampleId = $request->get('id');
        $answer = $request->get('content');

        $example = Example::find($exampleId);
        $example->answer = $answer;
        return (int) $example->save();


    }
}
