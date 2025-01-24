<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    /**
     * Display the admin contactus index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.contactus.index');
    }
    /**
     * Handles AJAX requests for the datatables of contactus.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Yajra\DataTables\DataTableAbstract JSON response for DataTables
     */
    public function ajaxTable(Request $request)
    {
        $contactus = ContactUs::query();
        return Datatables::of($contactus)
            ->addIndexColumn()
            ->make(true);
    }
}
