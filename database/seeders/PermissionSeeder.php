<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'Quản lý dịch vụ-list',
            'Quản lý dịch vụ-create',
            'Quản lý dịch vụ-update',
            'Quản lý dịch vụ-delete',
            'Quản lý thu chi-list',
            'Quản lý thu chi-create',
            'Quản lý thu chi-update',
            'Quản lý thu chi-delete',
            'Quản lý giao ca-list',
            'Quản lý giao ca-create',
            'Quản lý giao ca-update',
            'Quản lý giao ca-delete',
            'Quản lý khách hàng-list',
            'Quản lý khách hàng-create',
            'Quản lý khách hàng-update',
            'Quản lý khách hàng-delete',
            'Quản lý đồ thất lạc-list',
            'Quản lý đồ thất lạc-create',
            'Quản lý đồ thất lạc-update',
            'Quản lý chi nhánh-list',
            'Quản lý chi nhánh-create',
            'Quản lý chi nhánh-update',
            'Quản lý chi nhánh-delete',
            'Quản lý ngôn ngữ-list',
            'Quản lý ngôn ngữ-update',
            'Quản lý đặt phòng-list',
            'Quản lý đặt phòng-create',
            'Quản lý đặt phòng-update',
            'Quản lý đặt phòng-delete',
            'Quản lý khách đoàn-list',
            'Quản lý khách đoàn-create',
            'Quản lý khách đoàn-update',
            'Quản lý khách đoàn-delete',
            'Quản lý báo cáo-Báo cáo',
            'Quản lý nhật ký-Nhật ký',
            'Quản lý tài khoản-list',
            'Quản lý tài khoản-create',
            'Quản lý tài khoản-update',
            'Quản lý tài khoản-delete',
            'Quản lý phòng-list',
            'Quản lý phòng-create',
            'Quản lý phòng-update',
            'Quản lý phòng-delete',
            'Quản lý công nợ-list',
            'Quản lý công nợ-update',
            'Quản lý loại phòng-list',
            'Quản lý loại phòng-create',
            'Quản lý loại phòng-update',
            'Quản lý loại phòng-delete',
            'Quản lý quyền-list',
            'Quản lý quyền-create',
            'Quản lý quyền-update',
            'Quản lý quyền-delete',
            'Quản lý thông tin chung-Thông tin cơ sở',
            'Quản lý hóa đơn-prinf',
        ];

        foreach ($permissions as $permission) {
            if (!Permission::where(['name' => $permission])->exists()){
                Permission::create(['name' => $permission]);
            }
        }
    }
}
