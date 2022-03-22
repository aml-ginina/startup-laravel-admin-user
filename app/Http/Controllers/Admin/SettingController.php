<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\SettingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Setting;
use Flash;
use Response;

class SettingController extends AppBaseController
{
    /** @var  SettingRepository */
    private $settingRepository;

    public function __construct(SettingRepository $settingRepo)
    {
        $this->settingRepository = $settingRepo;
    }

    /**
     * Display a listing of the Setting.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $view = (in_array($request->view, ['grid', 'table']) ? $request->view : 'grid');

        if($view == 'grid') {
            $pluck = Setting::where('group', '!=', '')->groupBy('group')->pluck('group');
            $groups = [];
            foreach ($pluck as $group) {
                $groups[] = [
                    'name' => $group,
                    'description' => Setting::where('group', $group)->first()->description,
                    'count' => Setting::where('group', $group)->count()
                ];
            }

            usort($groups, function ($a, $b){
                return strcmp($a['name'], $b['name']);
            });

            return view('admin.settings.index')
                ->with('groups', $groups)
                ->with('view', $view);
        }

        $settings = $this->settingRepository->all();

        return view('admin.settings.index')
            ->with('settings', $settings)
            ->with('view', $view);
    }

    /**
     * Display the specified Setting.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        if($id == 'no-group') {
            $settings = Setting::where('group', null)->get();
            return view('admin.settings.show')->with('settings', $settings)->with('id', $id);
        }

        $setting = $this->settingRepository->find($id);
        if (empty($setting)) {
            $settings = Setting::where('group', $id)->get();
            if(empty($settings)) {
                Flash::error(__('messages.not_found', ['model' => __('models/settings.singular')]));
                return redirect(route('admin.settings.index'));
            }
            return view('admin.settings.show')->with('settings', $settings)->with('id', $id);
        }

        $settings = [$setting];
        return view('admin.settings.show')->with('settings', $settings)->with('id', $id);
    }

    /**
     * Update the specified Setting in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        if($id == 'no-group') {
            $settings = Setting::where('group', null)->get();
        } elseif(!empty($setting = $this->settingRepository->find($id))) {
            $settings = [$setting];
        } else {
            $settings = Setting::where('group', $id)->get();
            if(empty($settings)) {
                Flash::error(__('messages.not_found', ['model' => __('models/settings.singular')]));
                return redirect(route('admin.settings.index'));
            }
        }

        foreach($settings as $setting) {
            if(!is_null($rules = $setting->rules)) $this->validate($request, [$key = $setting->key => $rules]);
            if($setting->type == 'file') {
                if ($request->hasFile($key)) {
                    $file = $request->file($key);
                    if($file->isValid()) {
                        $filename = time().substr($file->getClientOriginalName(), -20);
                        $file->move(public_path('images/settings'), $filename);
                        $setting = $this->settingRepository->update(['value' => $filename], $setting->id);
                    }
                }
            } else {
                $setting = $this->settingRepository->update(['value' => $request->$key], $setting->id);
            }
            
        }

        Flash::success(__('messages.updated', ['model' => __('models/settings.singular')]));
        return redirect(route('admin.settings.index'));
    }
}
