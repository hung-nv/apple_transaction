<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Models\MenuSystem;
use Illuminate\Support\Facades\Session;
use App\Services\ImageServices;

class MenuSystemController extends Controller
{
    protected $image;

    public function __construct(ImageServices $image)
    {
    	parent::__construct();
        $this->image = $image;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $menuSystem = DB::table('menu_system')->get()->toArray();

        $data = setMultiMenu($menuSystem);

        return view('backend.menusystem.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menuSystem = DB::table('menu_system')->get()->toArray();

        $data = setMultiMenu($menuSystem);

        return view('backend.menusystem.create', [
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'label' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/menuSystem/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $menuSystem = new MenuSystem;
            $menuSystem->label = $request['label'];
            $menuSystem->icon = $request['icon'];
            $menuSystem->route = $request['route'];
            $menuSystem->parent_id = $request['parent_id'];
            $menuSystem->status = 1;

            if ($menuSystem->save())
                return redirect()->route('menuSystem.index')->with(['success_message' => 'Your menu has been created!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menuSystem = MenuSystem::findOrFail($id);

        $all = DB::table('menu_system')->get()->toArray();

        $data = setMultiMenu($all);

        return view('backend.menusystem.update', [
            'menuSystem' => $menuSystem,
            'data' => $data
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $menuSystem = MenuSystem::find($id);

        Validator::make($request->all(), [
            'label' => 'required|max:255'
        ])->validate();

        $menuSystem->label = $request['label'];
        $menuSystem->icon = $request['icon'];
        $menuSystem->route = $request['route'];
        $menuSystem->parent_id = $request['parent_id'];
        $menuSystem->status = $request['status'];

        if ($menuSystem->save())
            return redirect()->route('menuSystem.index')->with(['success_message' => 'Your menu has been updated!']);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $menuSystem = MenuSystem::find($id);

        if ($menuSystem->delete()) {
            $this->image->deleteImage($menuSystem->image);
            Session::flash('success_message', 'Your menu has been delete!');
        } else {
            Session::flash('error_message', 'Fail to delete menu');
        }
        return redirect('/admin/menuSystem');
    }
}
