<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //清空表
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \Illuminate\Support\Facades\DB::table('model_has_permissions')->truncate();
        \Illuminate\Support\Facades\DB::table('model_has_roles')->truncate();
        \Illuminate\Support\Facades\DB::table('role_has_permissions')->truncate();
        \Illuminate\Support\Facades\DB::table('users')->truncate();
        \Illuminate\Support\Facades\DB::table('roles')->truncate();
        \Illuminate\Support\Facades\DB::table('permissions')->truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //用户
        $user = \App\Models\User::create([
            'name' => 'root',
            'email' => 'root@dgg.net',
            'phone' => '18988888888',
            'password' => '123456',
        ]);

        //角色
        $role = \Spatie\Permission\Models\Role::create([
            'name' => 'root',
            'display_name' => '超级管理员'
        ]);

        //权限
        $permissions = [
            [
                'name' => 'system.manage',
                'display_name' => '系统管理',
                'route' => '',
                'icon_id' => '100',
                'child' => [
                    [
                        'name' => 'system.user',
                        'display_name' => '用户管理',
                        'route' => 'admin.user',
                        'icon_id' => '123',
                        'child' => [
                            ['name' => 'system.user.create', 'display_name' => '添加用户','route'],
                            ['name' => 'system.user.edit', 'display_name' => '编辑用户'],
                            ['name' => 'system.user.destroy', 'display_name' => '删除用户'],
                            ['name' => 'system.user.role', 'display_name' => '分配角色'],
                            ['name' => 'system.user.permission', 'display_name' => '分配权限'],
                        ]
                    ],
                    [
                        'name' => 'system.role',
                        'display_name' => '角色管理',
                        'route' => 'admin.role',
                        'icon_id' => '121',
                        'child' => [
                            ['name' => 'system.role.create', 'display_name' => '添加角色'],
                            ['name' => 'system.role.edit', 'display_name' => '编辑角色'],
                            ['name' => 'system.role.destroy', 'display_name' => '删除角色'],
                            ['name' => 'system.role.permission', 'display_name' => '分配权限'],
                        ]
                    ],
                    [
                        'name' => 'system.permission',
                        'display_name' => '权限管理',
                        'route' => 'admin.permission',
                        'icon_id' => '12',
                        'child' => [
                            ['name' => 'system.permission.create', 'display_name' => '添加权限'],
                            ['name' => 'system.permission.edit', 'display_name' => '编辑权限'],
                            ['name' => 'system.permission.destroy', 'display_name' => '删除权限'],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'zixun.manage',
                'display_name' => '资讯管理',
                'route' => '',
                'icon_id' => '100',
                'child' => [
                    [
                        'name' => 'zixun.category',
                        'display_name' => '分类管理',
                        'route' => 'admin.category',
                        'icon_id' => '29',
                        'child' => [
                            ['name' => 'zixun.category.create', 'display_name' => '添加分类'],
                            ['name' => 'zixun.category.edit', 'display_name' => '编辑分类'],
                            ['name' => 'zixun.category.destroy', 'display_name' => '删除分类'],
                        ]
                    ],
                    [
                        'name' => 'zixun.tag',
                        'display_name' => '标签管理',
                        'route' => 'admin.tag',
                        'icon_id' => '15',
                        'child' => [
                            ['name' => 'zixun.tag.create', 'display_name' => '添加标签'],
                            ['name' => 'zixun.tag.edit', 'display_name' => '编辑标签'],
                            ['name' => 'zixun.tag.destroy', 'display_name' => '删除标签'],
                        ]
                    ],
                    [
                        'name' => 'zixun.article',
                        'display_name' => '文章管理',
                        'route' => 'admin.article',
                        'icon_id' => '89',
                        'child' => [
                            ['name' => 'zixun.article.create', 'display_name' => '添加文章'],
                            ['name' => 'zixun.article.edit', 'display_name' => '编辑文章'],
                            ['name' => 'zixun.article.destroy', 'display_name' => '删除文章'],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'config.manage',
                'display_name' => '配置管理',
                'route' => '',
                'icon_id' => '28',
                'child' => [
                    [
                        'name' => 'config.site',
                        'display_name' => '站点配置',
                        'route' => 'admin.site',
                        'icon_id' => '25',
                        'child' => [
                            ['name' => 'config.site.update', 'display_name' => '更新配置',]
                        ]
                    ],
                    [
                        'name' => 'config.position',
                        'display_name' => '广告位置',
                        'route' => 'admin.position',
                        'icon_id' => '30',
                        'child' => [
                            ['name' => 'config.position.create', 'display_name' => '添加广告位',],
                            ['name' => 'config.position.edit', 'display_name' => '编辑广告位',],
                            ['name' => 'config.position.destroy', 'display_name' => '删除广告位',],
                        ]
                    ],
                    [
                        'name' => 'config.advert',
                        'display_name' => '广告信息',
                        'route' => 'admin.advert',
                        'icon_id' => '107',
                        'child' => [
                            ['name' => 'config.advert.create', 'display_name' => '添加信息',],
                            ['name' => 'config.advert.edit', 'display_name' => '编辑信息',],
                            ['name' => 'config.advert.destroy', 'display_name' => '删除信息',],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'member.manage',
                'display_name' => '会员管理',
                'route' => '',
                'icon_id' => '59',
                'child' => [
                    [
                        'name' => 'member.member',
                        'display_name' => '账号管理',
                        'route' => 'admin.member',
                        'icon_id' => '10',
                        'child' => [
                            ['name' => 'member.member.create', 'display_name' => '添加账号'],
                            ['name' => 'member.member.edit', 'display_name' => '编辑账号'],
                            ['name' => 'member.member.destroy', 'display_name' => '删除账号'],
                        ]
                    ],
                ]
            ]
        ];

        foreach ($permissions as $pem1) {
            //生成一级权限
            $p1 = \Spatie\Permission\Models\Permission::create([
                'name' => $pem1['name'],
                'display_name' => $pem1['display_name'],
                'route' => $pem1['route']??'',
                'icon_id' => $pem1['icon_id']??1,
            ]);
            //为角色添加权限
            $role->givePermissionTo($p1);
            //为用户添加权限
            $user->givePermissionTo($p1);
            if (isset($pem1['child'])) {
                foreach ($pem1['child'] as $pem2) {
                    //生成二级权限
                    $p2 = \Spatie\Permission\Models\Permission::create([
                        'name' => $pem2['name'],
                        'display_name' => $pem2['display_name'],
                        'parent_id' => $p1->id,
                        'route' => $pem2['route']??1,
                        'icon_id' => $pem2['icon_id']??1,
                    ]);
                    //为角色添加权限
                    $role->givePermissionTo($p2);
                    //为用户添加权限
                    $user->givePermissionTo($p2);
                    if (isset($pem2['child'])) {
                        foreach ($pem2['child'] as $pem3) {
                            //生成三级权限
                            $p3 = \Spatie\Permission\Models\Permission::create([
                                'name' => $pem3['name'],
                                'display_name' => $pem3['display_name'],
                                'parent_id' => $p2->id,
                                'route' => $pem3['route']??'',
                                'icon_id' => $pem3['icon_id']??1,
                            ]);
                            //为角色添加权限
                            $role->givePermissionTo($p3);
                            //为用户添加权限
                            $user->givePermissionTo($p3);
                        }
                    }

                }
            }
        }

        //为用户添加角色
        $user->assignRole($role);

        //初始化的角色
        $roles = [
            ['name' => 'business', 'display_name' => '商务'],
            ['name' => 'assessor', 'display_name' => '审核员'],
            ['name' => 'channel', 'display_name' => '渠道专员'],
            ['name' => 'editor', 'display_name' => '编辑人员'],
            ['name' => 'admin', 'display_name' => '管理员'],
        ];
        foreach ($roles as $role) {
            \Spatie\Permission\Models\Role::create($role);
        }
    }
}
