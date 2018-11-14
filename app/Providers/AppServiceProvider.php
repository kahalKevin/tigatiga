<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redis;
use App\Model\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $categories = json_decode(Redis::get(env('REDIS_PREFIX').':categories'), true);

        // if (empty($categories)) {
            // $categories = Category::get();
            // $categories = $this->generatePageTree($categories);

            // Redis::set(env('REDIS_PREFIX').':categories', json_encode($categories));
        // }

        // View::share('categories', $categories);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    
    private function generatePageTree($datas, $parent = 0, $depth=0)
    {
        $ni=count($datas);
        if($ni === 0 || $depth > 1000) return ''; // Make sure not to have an endless recursion
        $tree = '<ul class="navbar-nav header-menu-list">';
        if ($depth > 0) {
            $tree = '<ul class="dropdown-menu ht-dropdown">';
        }
        for($i=0; $i < $ni; $i++){
            if($datas[$i]['parent_category_id'] == $parent){
                
                if ($depth >= 1) {
                    $tree .= '<li class="dropdown-submenu">';
                    $tree .= '<a class="dropdown-item dropdown-toggle" href="#">' . $datas[$i]['_name'] . '</a>';
                } elseif ($depth > 0) {
                    $tree .= '<li>';
                    $tree .= '<a class="dropdown-item" href="#">' . $datas[$i]['_name'] . '</a>';
                } else {
                    $tree .= '<li class="nav-item">';
                    $tree .= '<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">' . $datas[$i]['_name'] . '</a>';
                }
            
                $tree .= $this->generatePageTree($datas, $datas[$i]['id'], $depth+1);
                $tree .= '</li>';
            }
        }
        $tree .= '</ul>';
        return $tree;
    }
}
