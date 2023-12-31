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

    public function updateCoursePaymentInfo($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/update/paymentinfo', $data)
        );
    }

    public function updateCourseStatus($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/update/status', $data)
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

    public function getCoursePreviousLesson($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/sections/lessons/get/previous', $data)
        );
    }

    public function getCourseNextLesson($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/sections/lessons/get/next', $data)
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

    public function updateCourseLessonOrder($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/sections/lessons/update/order', $data)
        );
    }

    public function deleteCourseLesson($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/sections/lessons/delete', $data)
        );
    }

    #enrollments
    public function getCourseEnrollments($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/enrollments/get', $data)
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

    public function updateCourseEnrollmentCoupon($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/enrollments/update/coupon', $data)
        );
    }

    #payments
    public function getCoursePayments($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/payment/get', $data)
        );
    }

    public function getCoursePayment($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/payment/info', $data)
        );
    }

    public function createCoursePayment($data=[])
    {
        return json_decode(
            $this->apiPost('/courses/payment/create', $data)
        );
    }
    

}