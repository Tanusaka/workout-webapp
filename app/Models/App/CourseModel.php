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

    public function getCourseInstructors($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/get/instructors', $data)
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

    public function updateCourseDescription($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/update/description', $data)
        );
    }


    public function updateCourseInstructor($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/update/instructor', $data)
        );
    }


    public function deleteCourse($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/delete', $data)
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

    public function deleteCourseSection($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/sections/delete', $data)
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

    public function deleteCourseLesson($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/sections/lessons/delete', $data)
        );
    }

    #instructors
    // public function getCourseInstructors($data=[])
    // {
    //     return json_decode(
    //         $this->apiPost('/courses/instructors/get', $data)
    //     );
    // }

    // public function getInstructorsForCourse($data=[])
    // {
    //     return json_decode(
    //         $this->apiPost('/courses/instructors/get/trainers', $data)
    //     );
    // }

    // public function saveCourseInstructor($data=[])
    // {
    //     return json_decode(
    //         $this->apiPost('/courses/instructors/save', $data)
    //     );
    // }

    // public function deleteCourseInstructor($data=[])
    // {
    //     return json_decode(
    //         $this->apiPost('/courses/instructors/delete', $data)
    //     );
    // }

    #reviews
    // public function getCourseReviews($data=[])
    // {
    //     return json_decode(
    //         $this->apiPost('/courses/reviews/get', $data)
    //     );
    // }

    // public function saveCourseReview($data=[])
    // {
    //     return json_decode(
    //         $this->apiPost('/courses/reviews/save', $data)
    //     );
    // }

    // public function deleteCourseReview($data=[])
    // {
    //     return json_decode(
    //         $this->apiPost('/courses/reviews/delete', $data)
    //     );
    // }

    #enrollments
    public function getUsersForEnroll($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/enrollments/get/users', $data)
        );
    }

    public function getCourseEnrollments($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/enrollments/course', $data)
        );
    }

    public function resetCourseEnrollments($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/enrollments/course/reset', $data)
        );
    }

    public function saveCourseEnrollment($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/enrollments/save', $data)
        );
    }

    public function deleteCourseEnrollment($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/enrollments/delete', $data)
        );
    }

    public function acceptCourseEnrollment($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/enrollments/accept', $data)
        );
    }
    

}