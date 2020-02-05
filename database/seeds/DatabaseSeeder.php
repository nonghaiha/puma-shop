<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UserSeeder');
        $this->call('CategoryTableSeeder');
        $this->call('AttributeTableSeeder');
    }
    
}
class UserSeeder extends Seeder
{
     public function run()
    {

         $data=[
             [
                'email'=>'manhtien@gmail.com',
                'password'=>bcrypt('123456'),
                'name'=>'Tiến',
                'usename'=>'manhtien',
                'image'=>'user.png'
             ],
             [
                'email'=>'manhtieno97@gmail.com',
                'password'=>bcrypt('123abc'),
                'name'=>'Mạnh Tiến',
                'usename'=>'tien123',
                'image'=>'user.png'
             ],
        ];
        DB::table('users')->insert($data);
    }
}
class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        $data=[
            [
                'name'=>'Nữ',
                'status'=>1,
                'cat_slug'=>'nu',
                'parent_id'=>0,
            ],
            [
                'name'=>'Quần',
                'status'=>1,
                'cat_slug'=>'quan',
                'parent_id'=>1,
            ]
        ];
        DB::table('category')->insert($data);
    }
}
class AttributeTableSeeder extends Seeder
{
    public function run()
    {
        $data=[
            [
                'name'=>'Cỡ M',
                'value'=>'M',
                'type'=>'size',
            ],
            [
                'name'=>'Màu đỏ',
                'value'=>'Red',
                'type'=>'color',
            ],
        ];
        DB::table('attribute')->insert($data);
    }
}
