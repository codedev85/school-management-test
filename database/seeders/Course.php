<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course as CourseData;
use Illuminate\Support\Str;

class Course extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courseList =  ['Physics','Geography','Math',
                        'English','Social Studies' ,
                        'Chemistry','Further Maths','Geology',
                        'Business Admin','GNS101' , 'GNS102',
                         'Pascal','Fortran','Biology'];
        for ($i=0; $i < count($courseList); $i++) {
            $courses[] = [
                'name' => $courseList[$i],
            ];
        }

        foreach ($courses as $course) {
            CourseData::create($course);
        }
    }
}
