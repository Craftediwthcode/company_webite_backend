<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
