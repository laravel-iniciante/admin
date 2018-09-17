<?php

use Illuminate\Database\Seeder;

class AclTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$idsRole = $this->createRoles();
        $idsPerm = $this->createPermissions();
        $this->sync($idsRole, $idsPerm);

    }

	private function createRoles()
    {
        
        $roles = [
        	['label'=> 'Super Usuario', 'name' => 'superusuario'], 
        	['label'=> 'Adimin', 		'name' => 'admin'], 
        	['label'=> 'Gerente', 		'name' => 'gerente']
        ];

        $rolesIds = [];

        foreach ($roles as $role):
            $id = DB::table('roles')->insertGetId([
	            'name' 	=> $role['name'],
	            'label' 	=> $role['label']
	        ]);
	        $rolesIds[] = $id;
        endforeach;
        
        return $rolesIds;
    }

	private function createPermissions()
    {
        
        $permissions = [

        	['label' =>'Listar usuários', 		'name' => 'users.list'], 	
        	['label' =>'Criar usuários', 		'name' => 'users.create'],    
        	['label' =>'Editar usuários',		'name' => 'users.update'], 		
        	['label' =>'Excluir usuários', 		'name' => 'users.destroy'],

        	['label' =>'Listar categorias', 	'name' => 'category.list'], 
        	['label' =>'Criar categorias', 		'name' => 'category.create'], 
        	['label' =>'Editar categorias',		'name' => 'category.update'], 	
        	['label' =>'Excluir categorias', 	'name' => 'category.destroy'],

        	['label' =>'Listar produtos', 		'name' => 'product.list'], 	
        	['label' =>'Criar produtos', 		'name' => 'product.create'],  
        	['label' =>'Editar produtos',		'name' => 'product.update'], 		
        	['label' =>'Excluirprodutos', 		'name' => 'product.destroy'],

        ]; 

        $permIds = [];

        foreach ($permissions as $permission):
            $id = DB::table('permissions')->insertGetId([
            	'name' => $permission['name'],
            	'label' => $permission['label']
            ]);
            $permIds[] = $id;
        endforeach;
        
        return $permIds;

    }

    private function sync($idsRole, $idsPerm)
    {
        foreach ($idsRole as $idRole) :
        	foreach ($idsPerm as $idPerm) :
	            DB::table('permission_role')->insertGetId([
	            	'permission_id' => $idPerm,
	            	'role_id' 		=> $idRole
	            ]);
	        endforeach;
        endforeach;
    }


}
