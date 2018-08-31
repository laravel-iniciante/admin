<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get()->toArray();

        $tree = $this->menu_categorias( ' - ', $categories, null);



        return view('category-list',compact('category','tree'));
    }


    protected function generateCategoryLists($elements, $parentId = 0,$indent = 0) {
        $html = '';
        foreach ($elements as $key => $element) {
            if ($element->sub_category_id == $parentId) {
                $html .= '<ul>';
                $html .= '<li>' .$element->id . ' - ' . $element->name . '</li>';
                $html .= '</ul>';
                $children = $this->generateCategoryLists($elements, $element->id,$indent + 1);
            }
        }
        return $html;
    }

    protected function menu_categorias( $sep = '',  $menus, $parent = 0, $level = 0)
    {
        $ret = '<ul>';
        foreach($menus as $m)
        {

            if($m['sub_category_id'] == $parent)
            {
                echo 'd';
                $ret .= '<li id="categoria-'. $m['id'] .'"> ';
                $ret .= '<a href="busca/?categoria='.$m['id'] .'" >';
                $ret .= ' '. $sep . ' ' ;
                $ret .= $m['id'] . ' - ' . $m['name'];
                $ret .= '</a>';
                $ret .= $this->menu_categorias($sep . '—' ,$menus, $m['id'], $level + 1);
                $ret .= '</li>';
            }
        }
        return $ret.'</ul>';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
