<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Post;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $this->authorize('view', $setting);
        return view('dashboard.settings.setting');
    }
    public function update(SettingRequest $request, Setting $setting)
    {
        try {
            $setting->update($request->except('logo', 'favicon', '_token'));
            if ($request->hasFile('logo') && $request->logo != '') {
                $logo_path = $setting->logo;  // Value is not URL but directory file path
                if (File::exists($logo_path)) {
                    File::delete($logo_path);
                }
                $setting->update(['logo' => uploadImage('dashboard/img/settings/', $request->logo)]);
            }
            if ($request->hasFile('favicon') && $request->favicon != '') {
                $favicon_path = $setting->favicon;  // Value is not URL but directory file path
                if (File::exists($favicon_path)) {
                    File::delete($favicon_path);
                }
                $setting->update(['favicon' => uploadImage('dashboard/img/settings/', $request->favicon)]);
            }
            if ($setting)
                return redirect()->route('settings.index')->with(['success' => __('words.edit successfuly')]);
        } catch (\Throwable $th) {
            return redirect()->route('settings.index')->with(['error' => __('words.there are something wrong please try again later')]);
        }
    }
}
