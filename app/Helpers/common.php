<?php

use App\Models\GeneralSetting;
use App\Models\ParentCategory;
use App\Models\Category;

/** 
 * Site Information 
 */

if (!function_exists('settings')) {
    function settings()
    {
        $settings = GeneralSetting::take(1)->first();
        if (!is_null($settings)) {
            return $settings;
        }
    }
}

/** 
 * Dynamic navigation menu
 */
if (!function_exists('navigations')) {
    function navigations()
    {
        $navigations_html = '';
        // With Dropdown
        $pcategories = ParentCategory::whereHas('children', function ($q) {
            $q->whereHas('posts');
        })->orderBy('name', 'asc')->get();

        // Without Dropdown
        $categories = Category::whereHas('posts')->where('parent', 0)->orderBy('name', 'asc')->get();

        if (count($pcategories) > 0) {
            foreach ($pcategories as $item) {
                $navigations_html .= '
                    <li class="nav-item drop-link">
                        <a class="nav-link food" href="#!">' . $item->name . ' <i class="fa fa-angle-down"
                                        aria-hidden="true"></i></a>
                            <ul class="dropdown">
                                    
                ';

                foreach ($item->children as $category) {
                    if ($category->posts->count() > 0) {
                        $navigations_html .= '<li><a href="#!">' . $category->name . '</a></li>';
                    }
                }

                $navigations_html .= '
                            </ul>
                    </li>
                ';
            }
        }

        if (count($categories) > 0) {
            foreach ($categories as $item) {
                $navigations_html .= '
                    <li class="nav-item dropdown">
                        <a class="nav-link travel" href="#!">' . $item->name . ' <i class="fa fa-angle-down"
                                        aria-hidden="true"></i></a>
                    </li>
                ';
            }
        }

        return $navigations_html;
    }
}
