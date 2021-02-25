<?php
use App\Borrow;
use Illuminate\Database\Seeder;

class BorrowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Borrow::class,10)->create();
    }
}
