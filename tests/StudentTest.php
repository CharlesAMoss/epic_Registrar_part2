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

    class StudentTest extends PHPUnit_Framework_TestCase
    {

//tearDown function runs after every method
        protected function tearDown()
        {
            Student::deleteAll();
            Course::deleteAll();
        }

    function test_save()
    {
        //Arrange
        $student_name = 'Abe Lincoln';
        $enroll_date = '06-15-2015';
        $test_student = new Student($student_name, $enroll_date);

        //Act
        $test_student->save();
        $result = Student::getAll();

        //Assert
        $this->assertEquals($test_student, $result[0]);
    }

//test for get all function
    function test_getAll()
    {
        $student_name = "Abe Lincoln";
        $enroll_date = "06-15-2015";
        $test_student = new Student ($student_name, $enroll_date);
        $test_student->save();
        $student_name2 = "George Washington";
        $enroll_date2 = "05-30-2015";
        $test_student2 = new Student ($student_name2, $enroll_date2);
        $test_student2->save();

        $result = Student::getAll();

        $this->assertEquals([$test_student, $test_student2], $result);
    }

    function test_deleteAll()
    {
        $student_name = "Abe Lincoln";
        $enroll_date = "06-15-2015";
        $test_student = new Student ($student_name, $enroll_date);
        $test_student->save();
        $student_name2 = "George Washington";
        $enroll_date2 = "05-30-2015";
        $test_student2 = new Student ($student_name2, $enroll_date2);
        $test_student2->save();

        Student::deleteAll();
        $result = Student::getAll();

        $this->assertEquals([], $result);
    }

    function test_getId()
    {
        $student_name = "Abe Lincoln";
        $enroll_date = "06-15-2015";
        $test_student = new Student ($student_name, $enroll_date);
        $test_student->save();

        $result = $test_student->getId();

        $this->assertEquals(true, is_numeric($result));
    }

    function test_find()
    {
        $student_name = "Abe Lincoln";
        $enroll_date = "06-15-2015";
        $test_student = new Student ($student_name, $enroll_date);
        $test_student->save();
        $student_name2 = "George Washington";
        $enroll_date2 = "05-30-2015";
        $test_student2 = new Student ($student_name2, $enroll_date2);
        $test_student2->save();

        $result = Student::find($test_student->getId());

        $this->assertEquals($test_student, $result);
    }

    function test_update()
    {
        $student_name = "Abe Lincoln";
        $enroll_date = "06-15-2015";
        $test_student = new Student ($student_name, $enroll_date);
        $test_student->save();
        $column_to_update = "student_name";
        $new_student_name = "Abraham Lincoln";

        $test_student->update($column_to_update, $new_student_name);
        $result = Student::getAll();

        $this->assertEquals("Abraham Lincoln", $result[0]->getStudentName());
    }

    function test_deleteOne()
    {
        $student_name = "Abe Lincoln";
        $enroll_date = "06-15-2015";
        $test_student = new Student ($student_name, $enroll_date);
        $test_student->save();
        $student_name2 = "George Washington";
        $enroll_date2 = "05-30-2015";
        $test_student2 = new Student ($student_name2, $enroll_date2);
        $test_student2->save();

        $test_student->deleteOne();

        $this->assertEquals([$test_student2], Student::getAll());
    }
}
?>
