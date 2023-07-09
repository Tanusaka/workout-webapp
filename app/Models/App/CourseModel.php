<?php
/**
 *
 * @author Samu
 */
namespace App\Models\App;

use App\Models\Core\BaseModel;

class CourseModel extends BaseModel
{
    #courses
    public function get()
    {
        return json_decode(
            $this->apiGet('/courses')
        );
    }

    public function getCourse($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/get', $data)
        );
    }

    public function saveCourse($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/save', $data)
        );
    }

    public function updateCourse($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/update', $data)
        );
    }


    #sections
    public function getCourseSection($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/sections/get', $data)
        );
    }

    public function saveCourseSection($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/sections/save', $data)
        );
    }

    public function updateCourseSection($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/sections/update', $data)
        );
    }



    #lessons
    public function getCourseLesson($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/sections/lessons/get', $data)
        );
    }


    public function saveCourseLesson($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/sections/lessons/save', $data)
        );
    }

    public function updateCourseLesson($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/sections/lessons/update', $data)
        );
    }
}