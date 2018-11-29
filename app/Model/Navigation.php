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
            $navigation = json_encode(Navigation::generatePageTree());
            \Cache::forever($cacheName, $navigation);
        }
    }

    private static function createMenu(&$list,$parent=null, $level=-1){
        $level+=1;
        $foundSome = false;
        $fill = '';
        for( $i=0,$c=count($list);$i<$c;$i++ ){
            if( $list[$i]['parent_category_id']==$parent ){
                if( $foundSome==false ){
                    if($level == 0){
                        $fill .= '<ul class="navbar-nav header-menu-list" style="margin: 0 auto;">';
                    } else {
                        $fill .= '<ul class="dropdown-menu ht-dropdown">';
                    }
                    $foundSome = true;
                }
                $child = Navigation::createMenu($list, $list[$i]['id'], $level);
                if($level == 0){
                    $fill .= '<li class="nav-item">';
                    $fill .= '<a class="nav-link dropdown-toggle" href="' . url('/') . '/shop/index/'. $list[$i]['_slug'] .'" data-toggle="dropdown">'.$list[$i]['_name'].'</a>';
                } else if($child != ''){
                    $fill .= '<li class="dropdown-submenu">';
                    $fill .= '<a class="dropdown-item dropdown-toggle" href="' . url('/') . '/shop/index/'. $list[$i]['_slug'] .'">'.$list[$i]['_name'].'</a>';
                } else {
                    $fill .= '<li><a class="dropdown-item" href="' . url('/') . '/shop/index/'. $list[$i]['_slug'] .'">'.$list[$i]['_name'].'</a></li>'; 
                }
                $fill .= $child;
            }
        }
        if( $foundSome ){            
            $fill .=  '</ul>';
        }
        return $fill;
    }

    public static function createMenuMobile($datas, $parent = 0, $depth=0){
        $ni=count($datas);
        $tree = '';
        $end_tree = '';

        if ($depth > 0) {
            $tree = '<ul>';
            $end_tree = '</ul>';
        }

        if($ni === 0 || $depth > 1000) return $trees;

        for($i=0; $i < $ni; $i++) {
            if($datas[$i]['parent_category_id'] == $parent){
                $tree .= '<li>';
                $tree .= '<a href=' .  url('/') . '/shop/index/' . $datas[$i]['_slug'] . '>';
                $tree .= $datas[$i]['_name'];
                $tree .= '</a>';
                $tree .= Navigation::createMenuMobile($datas, $datas[$i]['id'], $depth+1);
                $tree .= '</li>';
            }
        }
        
        $tree .= $end_tree;

        return $tree;
    }

    private static function generatePageTree()
    {
        $items = Navigation::all();
        
        $menu_desktop = '<div class="collapse navbar-collapse" id="navbarNavDropdown">';
        $menu_desktop .= Navigation::createMenu($items);
        $menu_desktop .= '</div>';

        $menu_mobile = Navigation::createMenuMobile($items);

        return [
            'navigation_desktop' => $menu_desktop,
            'navigation_mobile' => $menu_mobile
        ];
    }    
}
