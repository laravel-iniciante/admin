<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @package
 *
 * funções especiais desenvolvidas para auxiliar
 * no uso da tabela categoria do banco
 *
 */

class cat{

    private $categorias_ancestrais = array() ;

	public function __construct(){
		$this->ci = & get_instance();
		$this->ci->load->database();
	}


    public function extrair_categorias_ancestrais($categoria_atual, $arr_categorias ){

        $mycat = array();

        foreach ($arr_categorias as $cat) {
            if( $cat->id_categoria == $categoria_atual  ){
                if( $cat->pai != 0 ){
                    $this->categorias_ancestrais[] = $cat;
                    $this->extrair_categorias_ancestrais($cat->pai, $arr_categorias );
                }else{
                    $this->categorias_ancestrais[] = $cat;
                }
            }
        }
        return $this->categorias_ancestrais;
    }


	/**
	 * Desenvolvido para adicionar um travessão a cada subcategoria de forma que o resultado
	 * seja uma estrutura parecida com uma árvore
	 *
	 * recebe um array multdimensional vindo do banco e retorna u array simples ([chave] => valor )
	 * para ser usado no form_dropdow do Codeigniter, adicionando um travessão ' — ' em cada subcategoria
	 *
	 * formato do array
	 *
	 * id_categoria
	 * nm_categoria
	 * pai(autorelacionamento com o id_categoria)
	 *
	 * @param string $sep
	 * @param arrayObj $cats
	 * @param int $parent
	 * @param int $level
	 * @return string
	 */

	function indenta_array_categorias($sep = '',  $cats, $default = NULL, $parent = 0, $level = 0){

    	$res = array();
    	if($default){
    		$res = array( 0 => $default );
    	}


        foreach($cats as $m){

            if($m->pai == $parent){
            	$sub = array();
                $res[$m->id_categoria] = $sep . $m->nm_categoria;
                $sub = $this->indenta_array_categorias ( $sep . '— ' ,$cats, NULL, $m->id_categoria, $level + 1);

				if( !empty($sub) ){
					foreach($sub as $chave => $valor){
						$res[$chave] = $valor;
					}
				}

            }
        }
        return $res;
    }


	/**
	 * Description
	 * @param string $sep
	 * @param arrayObj $menus
	 * @param int $parent
	 * @param int $level
	 * @return type
	 */
	function admin_list_categorias( $sep = '',  $menus, $parent = 0, $level = 0)
    {
        $ret = '<ul>';
        foreach($menus as $m)
        {
            if($m->pai == $parent)
            {
                $ret .= '<li> ';
                $ret .= '<a href="'. base_url('admin/categoria/delete/'.$m->id_categoria) .'" class="btn btn-small btn-danger">&#10005;</a> ';
                $ret .= '<a href="'. base_url('admin/categoria/update/'.$m->id_categoria) .'" class="btn btn-small btn-warning">&#9999;</a> ';
                $ret .= ' '. $sep . ' ' ;
                $ret .= $m->nm_categoria;
                $ret .= $this->admin_list_categorias ($sep . '—' ,$menus, $m->id_categoria, $level + 1);
                $ret .= '</li>';
            }
        }
        return $ret.'</ul>';
    }


	/**
	 * Description
	 * @param string $sep
	 * @param arrayObj $menus
	 * @param int $parent
	 * @param int $level
	 * @return type
	 */
	function menu_categorias( $sep = '',  $menus, $parent = 0, $level = 0)
    {
        $ret = '<ul>';
        foreach($menus as $m)
        {
            if($m->pai == $parent)
            {
                $ret .= '<li id="categoria-'. $m->id_categoria .'"> ';
                $ret .= '<a href="'. base_url('busca/?categoria='.$m->id_categoria) .'" >';
                $ret .= ' '. $sep . ' ' ;
                $ret .= $m->nm_categoria;
                $ret .= '</a>';
                $ret .= $this->menu_categorias($sep . '—' ,$menus, $m->id_categoria, $level + 1);
                $ret .= '</li>';
            }
        }
        return $ret.'</ul>';
    }
}

