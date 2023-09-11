<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'title' => 'role_create',
            ],
            [
                'title' => 'role_edit',
            ],
            [
                'title' => 'role_show',
            ],
            [
                'title' => 'role_delete',
            ],
            [
                'title' => 'role_access',
            ],
            [
                'title' => 'employee_create',
            ],
            [
                'title' => 'employee_edit',
            ],
            [
                'title' => 'employee_show',
            ],
            [
                'title' => 'employee_delete',
            ],
            [
                'title' => 'employee_access',
            ],
            [
                'title' => 'chitiethoadonnhap_edit',
            ],
            [
                'title' => 'chitiethoadonnhap_delete',
            ],
            [
                'title' => 'chitiethoadonxuat_edit',
            ],
            [
                'title' => 'chitiethoadonxuat_delete',
            ],
        ];

        Permission::insert($permissions);
    }
}
