<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Course.php";
    require_once "src/Student.php";

// server signin
    $server = 'mysql:host=localhost;dbname=registrar_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CourseTest extends PHPUnit_Framework_TestCase
    {

//tearDown function runs after every method
        // protected function tearDown()
        // {
        //     Course::deleteAll();
        //     // Stylist::deleteAll();
        // }

    // function test_save()
    // {
    //     //Arrange
    //     $course_name = 'History';
    //     $course_number = 'HIST 101';
    //     $test_course = new Course($course_name, $course_number);
    //
    //     //Act
    //     $test_course->save();
    //     $result = Course::getAll();
    //
    //     //Assert
    //     $this->assertEquals($test_course, $result[0]);
    // }

//test for get all function
    function test_getAll()
    {
        $course_name = "History";
        $course_number = "HIST 101";
        $test_course = new Course ($course_name, $course_number);
        $test_course->save();
        $course_name2 = "Biology";
        $course_number2 = "BIO 101";
        $test_course2 = new Course ($course_name2, $course_number2);
        $test_course2->save();

        $result = Course::getAll();

        $this->assertEquals([$test_course, $test_course2], $result);
    }
}
?>
