<?php
namespace App\Http\Helpers;

use COM;

class AppHelper
{
    // Existing constants and methods...
    const LEVEL_BACHELOR = 1;
    const LEVEL_ASSOCIATE = 2;
    const LEVEL_VOCATION = 3;

    const LEVEL = [
        self::LEVEL_BACHELOR => 'bacheclor',
        self::LEVEL_ASSOCIATE => 'associate',
        self::LEVEL_VOCATION => 'vocational',
    ];

    public static function getStudyLevel()
    {
        return array_map(function($key) {
            return __('lang.' . $key);
        }, self::LEVEL);
    }

    public static function studyLevel($level)
    {
        // Check if the level exists in the LEVEL array
        return isset(self::LEVEL[$level]) ? __('lang.' . self::LEVEL[$level]) : __('lang.null');
    }


    const YEAR_LEVEL_1 = 1;
    const YEAR_LEVEL_2 = 2;
    const YEAR_LEVEL_3 = 3;
    const YEAR_LEVEL_4 = 4;

    const YEAR_LEVEL = [
        self::YEAR_LEVEL_1 => '1Year',
        self::YEAR_LEVEL_2 => '2Year',
        self::YEAR_LEVEL_3 => '3Year',
        self::YEAR_LEVEL_4 => '4Year',
    ];

    public static function getYearLevel(){
        return array_map(function($key) {
            return __('lang.' . $key);
        }, self::YEAR_LEVEL);
    }
    public static function yearLevel($level)
    {
        // Check if the level exists in the YEAR_LEVEL array
        return isset(self::YEAR_LEVEL[$level]) ? __('lang.' . self::YEAR_LEVEL[$level]) : __('lang.null');
    }

    const COURSE_TYPE_1 = 1;
    const COURSE_TYPE_2 = 2;
    const COURSE_TYPE_3 = 3;
    const COURSE_TYPE_4 = 4;
    const COURSE_TYPE_5 = 5;
    const COURSE_TYPE_6 = 6;
    const COURSE_TYPE = [
        self::COURSE_TYPE_1 => 'GeneralEducation',
        self::COURSE_TYPE_2 => 'BasicOrFoundationalSubjectGroupsOfSpecialization',
        self::COURSE_TYPE_3 => 'BasicCoreSubjectGroupOrCoreSubjectGroupOfSpecialization',
        self::COURSE_TYPE_4 => 'BasicElectiveSubjectsOrSpecializedElectiveSubjects',
        self::COURSE_TYPE_5 => 'Project',
        self::COURSE_TYPE_6 => 'Internship',
    ];
    public static function getCourseType()
    {
        return array_map(function($key) {
            return __('lang.' . $key);
        }, self::COURSE_TYPE);
    }
    public static function courseType($type)
    {
        // Check if the type exists in the COURSE_TYPE array
        return isset(self::COURSE_TYPE[$type]) ? __('lang.' . self::COURSE_TYPE[$type]) : __('lang.null');
    }

}
