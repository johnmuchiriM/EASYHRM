<?php

namespace Modules\Configurations\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Configurations\Entities\Configurations;
use App\Models\Timezone;
use Illuminate\Support\Facades\Validator;
use Auth;
use Session;

class ConfigurationsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $timezones = Timezone::Orderby('offset')->get();
        return view('configurations::index', compact('timezones'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('configurations::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator =  $request->validate([
            'config_app_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'config_app_favicon_icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $data = $request->except('_token');

        $data['config_company_name'] = strip_tags($request->config_company_name);
        $data['config_company_address'] = strip_tags($request->config_company_address);
        $data['config_app_name'] = strip_tags($request->config_app_name);
        $data['config_right_footer_1'] = strip_tags($request->config_right_footer_1);
        $data['config_right_footer_2'] = strip_tags($request->config_right_footer_2);
        $data['config_left_footer_1'] = strip_tags($request->config_left_footer_1);
        $data['config_left_footer_2'] = strip_tags($request->config_left_footer_2);

        //set appication favicon icon
        $data['config_app_favicon_icon'] = '';
        if ( $request->hasfile('config_app_favicon_icon')) {
            $file = $request->file('config_app_favicon_icon');
            $fileName = str_replace(' ','_',trim($file->getClientOriginalName()));
            $refactorName = preg_replace('/\s+/', '', $fileName);
            $file->move(public_path() . "/Configuration/Application/FaviconIcon", $refactorName);
            $data['config_app_favicon_icon'] = \URL("/Configuration/Application/FaviconIcon/" . $fileName);
        } else {
            $data['config_app_favicon_icon'] = getConfig('config_app_favicon_icon') ?? '';
        }

        //set appication logo
        $data['config_app_logo'] = '';
        if ( $request->hasfile('config_app_logo')) {
            $file = $request->file('config_app_logo');
            $fileName = str_replace(' ','_',trim($file->getClientOriginalName()));
            $refactorName = preg_replace('/\s+/', '', $fileName);
            $file->move(public_path() . "/Configuration/Application/Logo", $refactorName);
            $data['config_app_logo'] = \URL("/Configuration/Application/Logo/" . $fileName);
        } else {
            $data['config_app_logo'] = getConfig('config_app_logo') ?? '';
        }

        if(!isset($data['config_is_footer_fixed'])) {
            $data['config_is_footer_fixed'] = NULL;
        }  
        if(!isset($data['config_is_header_fixed'])) {
            $data['config_is_header_fixed'] = NULL;
        }  
        if(!isset($data['config_is_sidebar_fixed'])) {
            $data['config_is_sidebar_fixed'] = NULL;
        }

        Configurations::createORUpdateConfig($data);
        Session::flash('success', __('configurations::lang.configuration-updated'));
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('configurations::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('configurations::edit');
    }

}
