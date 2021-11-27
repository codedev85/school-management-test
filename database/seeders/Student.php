<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Student extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $studentsArray = array(
            ['full_name' => 'John Smith',
                'email' => 'john@gmail.com'],
            ['full_name' => 'Allan Shearer',
                'email' => 'allan@gmail.com'],
            ['full_name' => 'Jack Bauer',
                'email' => 'jack@gmail.com'],
            ['full_name' => 'Janet Jones',
                'email' => 'janet@gmail.com'],
            ['full_name' => 'Bard Pit',
                'email' => 'bradpit@gmail.com'],
            ['full_name' => 'Bishop Hilsong',
                'email' => 'bishop@gmail.com'],
            ['full_name' => 'Brad pit',
                'email' => 'brad@gmail.com'],
        );

        $courseID = \App\Models\Course::limit(count($studentsArray))->get();


        foreach($studentsArray as $index => $studentObj)
        {
            $student = new \App\Models\Student();
            $student->full_name = $studentObj['full_name'];
            $student->email     = $studentObj['email'];
            $student->save();
            $student->courses()->syncWithoutDetaching($courseID[$index]->id);
        }



    }
}
