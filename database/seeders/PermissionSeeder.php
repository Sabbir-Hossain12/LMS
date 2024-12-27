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
                'name' => 'Add Testimonial',
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
            ] ,

            [
                'name' => 'view dashboard',
                'guard_name' => 'web',
            ] ,

            [
                'name' => 'view dashboard',
                'guard_name' => 'web',
            ] ,

            [
                'name' => 'view dashboard',
                'guard_name' => 'web',
            ] ,
            
            
            
            
            
        ];
    }
}
