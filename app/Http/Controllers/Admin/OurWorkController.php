<?php

namespace App\Http\Controllers\Admin;

use App\Models\OurWork;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Validator, Response};

class OurWorkController extends Controller
{
    /**
     * Display the admin our work index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.our-work.index');
    }
    /**
     * Handles AJAX requests for the datatables of our work.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Yajra\DataTables\DataTableAbstract JSON response for DataTables
     */
    public function ajaxTable(Request $request)
    {
        $contactus = OurWork::query();
        return Datatables::of($contactus)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $action = "";
                $action = '<a href="' . route('our-work.edit', $data->id) . '" title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-edit"></i></a>';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    /**
     * Display the form for editing the specified our work.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module_data = OurWork::find($id);
        return view('admin.our-work.edit', compact('module_data'));
    }
    /**
     * Update the specified our work in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'count' => 'required',
            ]);
            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()]);
            }
            $ourwork = OurWork::find($id);
            $ourwork->update([
                'title' => $request->title,
                'count' => $request->count
            ]);
            return Response::json(['success' => __('Our Work Updated Successfully.')]);
        } catch (\Exception $e) {
            return Response::json(['error' => __('Something went wrong. Please try again.'), 'error' => $e->getMessage()]);
        }
    }
}
