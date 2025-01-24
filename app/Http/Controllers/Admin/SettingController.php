<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Validator, Response};

class SettingController extends Controller
{
    /**
     * Renders the admin setting view.
     *
     * @return \Illuminate\Http\Response
     */
    public function setting()
    {
        return view('admin.setting.setting');
    }
    /**
     * Handles the request to update the contact support settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateSupport(Request $request)
    {
        try {
            $settings = [
                ['key' => 'email', 'value' => $request->input('email')],
                ['key' => 'phone', 'value' => $request->input('phone')],
                ['key' => 'address', 'value' => $request->input('address')],
                ['key' => 'facebook_url', 'value' => $request->input('facebook_url')],
                ['key' => 'instagram_url', 'value' => $request->input('instagram_url')],
                ['key' => 'linkedin_url', 'value' => $request->input('linkedin_url')]
            ];
            foreach ($settings as $setting) {
                Setting::updateOrCreate(
                    ['key' => $setting['key']],
                    ['value' => $setting['value']]
                );
            }
            return back()->with('success', __('Contact Support Updated Successfully.'));
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => __('Database error occurred. Please try again.')]);
        } catch (\Exception $e) {
            return response()->json(['error' => __('Something went wrong. Please try again.')]);
        }
    }
    /**
     * Handles the request to update the logo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateLogo(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'logo_update' => 'required',
            ]);
            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()]);
            }
            $logo = Helper::imageUpload($request->file('logo_update'), 'uploads/logo');
            $logo = 'uploads/logo/' . $logo;
            Setting::updateOrCreate(
                ['key' => 'logo'],
                ['value' => $logo]
            );
            return back()->with('success', __('Logo Updated Successfully.'));
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => __('Database error occurred. Please try again.')]);
        } catch (\Exception $e) {
            return response()->json(['error' => __('Something went wrong. Please try again.')]);
        }
    }
}
