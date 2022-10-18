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
            'Dịch vụ-Danh sách',
            'Dịch vụ-Tạo mới',
            'Dịch vụ-Cập nhật',
            'Dịch vụ-Xóa',
            'Thu chi-Danh sách',
            'Thu chi-Tạo mới',
            'Thu chi-Cập nhật',
            'Thu chi-Xóa',
            'Giao ca-Danh sách',
            'Giao ca-Tạo mới',
            'Giao ca-Cập nhật',
            'Giao ca-Xóa',
            'Khách hàng-Danh sách',
            'Khách hàng-Tạo mới',
            'Khách hàng-Cập nhật',
            'Khách hàng-Xóa',
            'Đồ thất lạc-Danh sách',
            'Đồ thất lạc-Tạo mới',
            'Đồ thất lạc-Cập nhật',
            'Đồ thất lạc-Xóa',
            'Quản lý chi nhánh-Danh sách',
            'Quản lý chi nhánh-Tạo mới',
            'Quản lý chi nhánh-Cập nhật',
            'Quản lý chi nhánh-Xóa',
            'Quản lý đặt phòng-Danh sách',
            'Quản lý đặt phòng-Tạo mới',
            'Quản lý đặt phòng-Cập nhật',
            'Quản lý đặt phòng-Xóa',
            'Khách đoàn-Khách đoàn Danh sách',
            'Khách đoàn-Khách đoàn Tạo mới',
            'Khách đoàn-Khách đoàn Cập nhật',
            'Khách đoàn-Khách đoàn Xóa',
            'Báo cáo-Báo cáo',
            'Nhật kýNhật ký',
            'Quản lý tài khoản-Quản lý tài khoản Danh sách',
            'Quản lý tài khoản-Quản lý tài khoản Tạo mới',
            'Quản lý tài khoản-Quản lý tài khoản Cập nhật',
            'Quản lý tài khoản-Quản lý tài khoản Xóa',
            'Quản lý phòng-Danh sách',
            'Quản lý phòng-Tạo mới',
            'Quản lý phòng-Cập nhật',
            'Quản lý phòng-Xóa',
            'Quản lý quyền- Danh sách',
            'Quản lý quyền- Tạo mới',
            'Quản lý quyền- Cập nhật',
            'Quản lý quyền- Xóa',
            'Thông tin chung-Thông tin cơ sở',
        ];

        foreach ($permissions as $permission) {
            if (!Permission::where(['name' => $permission])->exists()){
                Permission::create(['name' => $permission]);
            }
        }
    }
}
