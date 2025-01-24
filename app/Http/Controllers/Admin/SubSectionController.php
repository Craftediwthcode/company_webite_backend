<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Response, Validator, File};

class SubSectionController extends Controller
{
    /**
     * Show the admin page index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.sub_section.index');
    }
    /**
     * Handles AJAX requests for the datatables of pages.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Yajra\DataTables\DataTableAbstract JSON response for DataTables
     */
    public function ajaxTable(Request $request)
    {
        $status = $request->status;
        $pages = $request->pages;
        $pages = Page::where('parent_id', '!=', 0)->with('parent')
        ->when($status !== null, function ($query) use ($status) {
            return $query->where('status', '=', $status);
        })
        ->when($request->pages !== null, function ($query) use ($pages) {
            return $query->where('parent_id', '=', $pages);
        });
        return Datatables::of($pages)
            ->addIndexColumn()
            ->editColumn('status', function ($data) {
                return "<div class='col-sm-2'><input type='checkbox' name='my-checkbox' class='bs-switch bootstrap-switch-small mb-2 pb-2' id='bs-switch" . $data->id . "' " . ($data->status == 'active' ? 'checked' : '') . "  data-bootstrap-switch data-off-color='danger' data-on-color='success'></div>";
            })
            ->editColumn('action', function ($data) {
                $action = "";
                $action = '<a href="' . route('sub-section.edit', $data->id) . '" title="Edit" class="btn btn-sm btn-info waves-effect waves-light"><i class="fa fa-edit"></i></a>';
                return $action;
            })
            ->addColumn('parent_name', function ($data) {
                return $data->parent->title ?? '';
            })
            ->rawColumns(['action', 'status','parent_name'])
            ->make(true);
    }
    /**
     * Show the form for creating a new page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sub_section.create');
    }
    /**
     * Store a newly created page in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'pages' => 'required',
            ]);
            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()]);
            }
            $imagePath = null;
            if ($request->hasFile('image')) {
                try {
                    $imagePath = Helper::imageUpload($request->file('image'), 'uploads/sub_pages/main_image');
                    $imagePath = 'uploads/sub_pages/main_image/' . $imagePath;
                } catch (\Exception $e) {
                    return Response::json(['error' => __('Could not upload the main image: ' . $e->getMessage())]);
                }
            }
            $bannerImagePath = null;
            if ($request->hasFile('banner_image')) {
                try {
                    $bannerImagePath = Helper::imageUpload($request->file('banner_image'), 'uploads/sub_pages/banner_image');
                    $bannerImagePath = 'uploads/sub_pages/banner_image/' . $bannerImagePath;
                } catch (\Exception $e) {
                    return Response::json(['error' => __('Could not upload the banner image: ' . $e->getMessage())]);
                }
            }
            Page::create([
                'parent_id' => $request->pages,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'description' => $request->description,
                'image' => $imagePath,
                'banner_image' => $bannerImagePath,
                'type'=> $request->type
            ]);
            return Response::json(['success' => __('Sub Section Created Successfully.')]);
        } catch (\Exception $e) {
            dd($e);
            return Response::json(['error' => __('Something went wrong. Please try again.')]);
        }
    }
    /**
     * Show the form for editing the specified page.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module_data = Page::with('parent')->find($id);
        return view('admin.sub_section.edit', compact('module_data'));
    }
    /**
     * Update the specified page in storage.
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
                'description' => 'required',
                'pages' => 'required',
            ]);
            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()]);
            }
            $page = Page::find($id);
            $imagePath = $page->image;
            if ($request->hasFile('image')) {
                try {
                    if ($imagePath && File::exists(public_path($imagePath))) {
                        File::delete(public_path($imagePath));
                    }
                    $imagePath = Helper::imageUpload($request->file('image'), 'uploads/sub_pages/main_image');
                    $imagePath = 'uploads/sub_pages/main_image/' . $imagePath;
                } catch (\Exception $e) {
                    return Response::json(['error' => __('Could not upload the main image: ' . $e->getMessage())]);
                }
            }
            $bannerImagePath = $page->banner_image;
            if ($request->hasFile('banner_image')) {
                try {
                    if ($bannerImagePath && File::exists(public_path($bannerImagePath))) {
                        File::delete(public_path($bannerImagePath));
                    }
                    $bannerImagePath = Helper::imageUpload($request->file('banner_image'), 'uploads/sub_pages/banner_image');
                    $bannerImagePath = 'uploads/sub_pages/banner_image/' . $bannerImagePath;
                } catch (\Exception $e) {
                    return Response::json(['error' => __('Could not upload the banner image: ' . $e->getMessage())]);
                }
            }
            $page->update([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'banner_image' => $bannerImagePath,
                'image' => $imagePath,
                'description' => $request->description,
                'type'=> $request->type
            ]);
            return Response::json(['success' => __('Sub Section Updated Successfully.')]);
        } catch (\Exception $e) {
            return Response::json(['error' => __('Something went wrong. Please try again.'), 'error' => $e->getMessage()]);
        }
    }
    /**
     * Change the status of a page.
     *
     * This method takes a page id and changes its status in the database.
     * If the status is '1', it will be changed to '0' and vice versa.
     *
     * @param \Illuminate\Http\Request $request The request containing the id of the page to be changed.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the success/error message.
     */
    public function status(Request $request)
    {
        $data = Page::findOrFail($request->id);
        $data->update(['status' => ($data->status == 'active' ? 'inactive' : 'active')]);
        if ($data->status == 'active') {
            return Response::json(['success' => __('Sub Section Activated Successfully.')]);
        } else {
            return Response::json(['error' => __('Sub Section Deactivated Successfully.')]);
        }
    }
}
