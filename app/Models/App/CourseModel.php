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
    public function getCourseInstructors($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/instructors/get', $data)
        );
    }

    public function getInstructorsForCourse($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/instructors/get/trainers', $data)
        );
    }

    public function saveCourseInstructor($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/instructors/save', $data)
        );
    }

    public function deleteCourseInstructor($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/instructors/delete', $data)
        );
    }

    #reviews
    public function getCourseReviews($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/reviews/get', $data)
        );
    }

    public function saveCourseReview($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/reviews/save', $data)
        );
    }

    public function deleteCourseReview($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/reviews/delete', $data)
        );
    }

    #followers
    public function getCourseFollowers($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/followers/get', $data)
        );
    }

    public function getFollowersForCourse($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/followers/get/users', $data)
        );
    }

    public function saveCourseFollower($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/followers/save', $data)
        );
    }

    public function deleteCourseFollower($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/followers/delete', $data)
        );
    }

}