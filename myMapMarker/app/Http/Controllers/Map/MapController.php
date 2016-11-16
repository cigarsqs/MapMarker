<?php namespace App\Http\Controllers\Map;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Map;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;


class MapController extends Controller {


    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        if (Auth::check()) {
            $maps = Map::all();
            return view('maps.index', compact('maps'));
        }else{
            return Redirect::action('WelcomeController@index');
        }
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        return view('maps.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
        $map = new Map();
        $map->title = Input::get('title');
        $map->context = Input::get('context');

        $isPublic = Input::get('isPublic');
        if($isPublic == 'on'){
            $map->is_public = '1';
        }elseif($isPublic == 'off'){
            $map->is_public = '0';
        }
        $map->published_at = Carbon::now();
        $map->user_id = Auth::User()->id;

        $map->save();
        $id = $map->id;
        $tags = Input::get('tags');

        $list_tags = explode(',',$tags);

        foreach( $list_tags as $tag) {
            $save_tag = Tag::firstOrCreate(['tag' => $tag]);
            $save_tag->belongsToManyMaps()->attach($id);
        }


        $maps= Auth::User()->maps;
        return Redirect::action('User\UserController@getMapsForAuthUser');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
        $map = Map::find($id);

        return view('maps.edit', compact('map'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function findByUserId($userId)
    {
        if (Auth::check()) {
            $maps = User::find($userId)->maps;
            return view('maps.index', compact('maps'));
        }else{
            return Redirect::action('WelcomeController@index');
        }

    }

    public function showMap($id){
        $mapDetail = Map::find($id);
        return view('maps.home',compact('mapDetail'));
    }

    public function getMapsByUserId($userId){
        $maps = Map::where('user_id','=',$userId);

        return view('maps.index',compact('maps'));

    }

}
