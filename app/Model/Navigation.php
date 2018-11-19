<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;


class Navigation extends Model
{
    use SoftDeletes;

    protected $dates = ['delete_at'];
    protected $table = "cms_tm_category";

    public function parent() {
        return $this->hasOne('App\Model\Navigation', 'id', 'parent_category_id');
    }

    public function children() {
        return $this->hasMany('App\Model\Navigation', 'parent_category_id', 'id');
    }  

    public static function tree() {
        return static::with(implode('.', array_fill(0, 4, 'children')))->where('parent_category_id', '=', NULL)->get();
    }

    public static function setNavigation(){
        $cacheName = "navigation";
     if (!\Cache::has($cacheName)) {
            $navigation = Navigation::generatePageTree();
            \Cache::forever($cacheName, $navigation);
        }
    }

    private static function generatePageTree()
    {
        $tree = "";
        $items = Navigation::tree();

        $tree = '<div class="collapse navbar-collapse" id="navbarNavDropdown">';
        $tree .= '<ul class="navbar-nav header-menu-list" style="margin: 0 auto;">';
        foreach($items as $item){
            $tree .= '<li class="nav-item">';
            $tree .= '<a class="nav-link dropdown-toggle" href="/shop/index/'. $item->_slug .'" data-toggle="dropdown">'.$item->_name.'</a>';
            $tree .= '<ul class="dropdown-menu ht-dropdown">';
                foreach ($item['children'] as $child) {
                    $tree .= '<li><a class="dropdown-item" href="/shop/index/'. $child->_slug .'">'.$child->_name.'</a></li>';  
                }
            $tree .= '</ul>';
            $tree .= '</li>';            
        }
        $tree .= '</ul>';
        $tree .= '</div>';

        return $tree;
    }    
}
