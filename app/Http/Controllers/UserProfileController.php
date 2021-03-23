<?php

namespace App\Http\Controllers;

class UserProfileController extends Controller
{
    public function userProfile()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => __('locale.Home')], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "User Profile Page"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.user-profile-page', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }
}
