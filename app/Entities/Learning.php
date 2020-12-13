<?php

namespace App\Entities;
use Illuminate\Support\Facades\Redis;
use App\Lecture;
use App\Course;

trait Learning{

    public function completeLecture($lecture)
    {
        Redis::sadd("User:{$this->id}:Course:{$lecture->course->id}", $lecture->id);
    }

    public function percentageCompletedForCourse($course)
    {
        $numberOfLecturesInCourse = $course->lectures->count();
        $numberOfCompletedLectures = $this->getNumberOfCompletedLecturesForACourse($course);

        return ($numberOfCompletedLectures/$numberOfLecturesInCourse) * 100;
    }

    public function getNumberOfCompletedLecturesForACourse($course)
    {
        return count($this->getCompletedLecturesForACourse($course));
    }

    public function getCompletedLecturesForACourse($course)
    {
        return Redis::smembers("User:{$this->id}:Course:{$course->id}");
    }

    public function hasStartedCourse($course)
    {
        return $this->getNumberOfCompletedLecturesForACourse($course) > 0; 
    }

    public function getCompletedLectures($course)
    {
        return Lecture::whereIn('id', 
            $this->getCompletedLecturesForACourse($course)
        )->get();
    }

    public function hasCompletedLecture($lecture)
    {
        return in_array($lecture->id, $this->getCompletedLecturesForACourse($lecture->course));
    }

    public function courseBeingWatchedIds()
    {
        $keys = Redis::keys("User:{$this->id}:Course:*");

        $courseIds = [];

        foreach($keys as $key){
            $courseId = explode(':', $key)[3];
            array_push($courseIds, $courseId);
        }

        return $courseIds;
    }

    public function courseBeingWatched()
    {
        return collect($this->courseBeingWatchedIds())->map(function($id){
            return Course::find($id);
        });
    }

    public function getTotalNumberOfCompletedLectures()
    {
        $keys = Redis::keys("User:{$this->id}:Course:*");
    
        $results = 0;

        foreach($keys as $key){
            $results += count(Redis::smembers($key));
        }
        
        return $results;
    }

    public function getNextLectureToWatch($course)
    {
        $lectureIds = $this->getCompletedLecturesForACourse($course);
        $lectureId = end($lectureIds);

        return Lecture::find($lectureId)->getNextLecture();
    }

}


?>