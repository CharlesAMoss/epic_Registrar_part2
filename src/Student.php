<?php
    class Student
    {
        private $student_name;
        private $enroll_date;
        private $id;

        function __construct($student_name, $enroll_date, $id=null)
        {
            $this->id = $id;
            $this->student_name = $student_name;
            $this->enroll_date = $enroll_date;
        }
//getters
        function getStudentName()
        {
            return $this->student_name;
        }

        function getEnrollDate()
        {
            return $this->enroll_date;
        }

        function getId()
        {
            return $this->id;
        }
//setters
        function setStudentName($new_student_name)
        {
            $this->student_name = (string) $new_student_name;
        }

        function setEnrollDate($new_enroll_date)
        {
            $this->enroll_date = (string) $new_enroll_date;
        }

//save function
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO students_t (student_name, enroll_date) VALUES ('{$this->getStudentName()}', '{$this->getEnrollDate()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

//see update() in Course.php for more detail
        function update($column_to_update, $new_student_information)
        {
            $GLOBALS['DB']->exec("UPDATE students_t SET {$column_to_update} = '{$new_student_information}' WHERE id = {$this->getId()};");
        }

//function to delete one student
        function deleteOne()
        {
            $GLOBALS['DB']->exec("DELETE FROM students_t WHERE id = {$this->getId()};");
        }

//function to retrieve all students
        static function getAll()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students_t;");
            $students = array();
            foreach($returned_students as $student) {
                $student_name = $student['student_name'];
                $enroll_date = $student['enroll_date'];
                $id = $student['id'];
                $new_student = new Student($student_name, $enroll_date, $id);
                array_push($students, $new_student);
            }
            return $students;
        }

//function to delete all students
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM students_t;");
        }

//function to find a single student
        static function find($search_id)
        {
            $found_student = null;
            $students = Student::getAll();
            foreach($students as $student) {
                $student_id = $student->getId();
                if ($student_id == $search_id) {
                    $found_student = $student;
                }
            }
            return $found_student;
        }

    }
?>
