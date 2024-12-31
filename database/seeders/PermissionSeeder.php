<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions=[
            
          [
              'name' => 'View Testimonial',
              'guard_name' => 'web',
          ] ,
            
            [
                'name' => 'Create Testimonial',
                'guard_name' => 'web',
            ] ,


            [
                'name' => 'Edit Testimonial',
                'guard_name' => 'web',
            ] ,


            [
                'name' => 'Delete Testimonial',
                'guard_name' => 'web',
            ] ,

            [
                'name' => 'Status Testimonial',
                'guard_name' => 'web',
            ],
            
            [
                'name'=> 'View HeroBanner',
                'guard_name' => 'web',
            ],
            
            [
                'name'=> 'View About',
                'guard_name' => 'web',
            ],

            
            [
                'name'=> 'View Blog',
                'guard_name' => 'web',
            ],
            [
                'name'=> 'Create Blog',
                'guard_name' => 'web',
            ]
            ,
            [
                'name'=> 'Edit Blog',
                'guard_name' => 'web',
            ],
            [
                'name'=> 'Delete Blog',
                'guard_name' => 'web',
            ],
            [
                'name'=> 'Status Blog',
                'guard_name' => 'web',
            ]
            ,
            [
                'name'=> 'View Page',
                'guard_name' => 'web',
            ],
            [
                'name'=> 'Create Page',
                'guard_name' => 'web',
            ]
            ,
            [
                'name'=> 'Edit Page',
                'guard_name' => 'web',
            ],
            
            [
                'name'=> 'Delete Page',
                'guard_name' => 'web',
            ],
            
            [
                'name'=> 'View Settings',
                'guard_name' => 'web',
            ],
            
            //Admins
            [
                'name'=> 'View Admin',
                'guard_name' => 'web',
            ],

            [
                'name'=> 'Create Admin',
                'guard_name' => 'web',
            ],
            
            [
                'name'=> 'Edit Admin',
                'guard_name' => 'web',
            ],
            
            [
                'name'=> 'Delete Admin',
                'guard_name' => 'web',
            ],
            
            [
                'name'=> 'Status Admin',
                'guard_name' => 'web',
            ],
            
            //Teacher
            
            
            
        ];
        
        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create($permission);
        }
    }
}
