<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(100,250) as $index){
            $time = $faker->dateTimeBetween('-6 month','+1 month');
            DB::table('orders')->insert([
                    'order_id' => Str::random(8),
                    'customer_id' => 43,
                    'payment_id' => 1,
                    'price_total'=> 1000000.00,
                    'status'=> "completed",
                    'confirm' => 1,
                    'created_at'=>$time,
            ]);
            DB::table('order_details')->insert([
                'order_id' => 99,
                'product_id' => 68,
                'product_price_total' => 1000000.00,
                'product_received_date'=> $time,
                'product_pay_date' => $time,
                'payments'=>"Nhận xe đại lý",
                'quantity'=> 1,
                'created_at'=>$time,
            ]);
        }

//        foreach (range(2,32) as $index){
//            DB::table('statisticals')->insert([
//                    'order_date' => "2021-05-04 00:00:00",
//                    'sales' => 888888888.00,
//                    'profit' => 888888888.00,
//                    'quantity'=> 123,
//                    'total_order'=> 123,
//                    'created_at' => "2021-05-04 21:02:47",
//                    'updated_at' => "2021-05-04 21:02:47"
//                ]);
//        }
//        foreach (range(50,250) as $index){
//            DB::table('users')->insert([
//                'name' => $faker->name,
//                'email'=>$faker->unique()->safeEmail,
//                'email_verified_at'=>null,
//                'password'=>encrypt('password'),
//                'two_factor_secret'=>null,
//                'two_factor_recovery_codes'=>null,
//                'utype'=>"USR",
//                'phone'=>"0906240410",
//                'district_id'=>null,
//                'city_id'=>null,
//                'address'=>"Đống Đa,Hà Nội",
//                'remember_token'=>null,
//                'current_team_id'=>null,
//                'profile_photo_path'=>"https://i.imgur.com/DVxX5dH.jpg",
//                'created_at'=>$faker->dateTimeBetween('-6 month','+1 month'),
//                'updated_at'=>null,
//                'deleted_at'=>null,
//                'cmt'=>'113222396',
//                'cmt_day'=>'2021-04-13',
//                'birth_day'=>'2021-04-13',
//                'tk_banks'=>'9704198526191432198',
//                'status'=>'instock'
//
//            ]);
//        }

        // \App\Models\User::factory(10)->create();
    }
}
