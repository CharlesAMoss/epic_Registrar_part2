
<?php


    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Course.php";
    require_once __DIR__."/../src/Student.php";


    $app = new Silex\Application();
    $app['debug'] = true;


    $server = 'mysql:host=localhost;dbname=registrar';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

//route to landing page; needs no input
    $app->get("/", function() use($app){
        return $app['twig']->render('index.html.twig');
    });

//route to add student page
    $app->get("/student_add", function() use($app){
        return $app['twig']->render('student_add.html.twig', array('students' => Student::getAll()));
    });

//route to post new information to database

    $app->post("/student_add", function() use ($app) {
       $student_name = $_POST['student_name'];
       $enroll_date = $_POST['enroll_date'];
       $student = new Student($student_name, $id = null, $enroll_date);
       $student->save();
       return $app['twig']->render('student_add.html.twig', array('student' => $student, 'students' => Student::getAll(), 'courses' => $task->getCourses(), 'all_courses' => Courses::getAll()));
    });




//route to view all students

//route to add course page

//route to view all courses






//route guideline for update function in student.php; getStudents method has yet to be created
    // $app->patch('/student/{id}', function($id) use ($app){
    //     $student = Student::find($id);
    //     $course = Course::find($_POST['course_id']);
    //     foreach ($_POST as $key => $value) {
    //         if (!empty ($value)) {
    //             $student->update($key, $value);
    //         }
    //     }
    //     return $app['twig']->render('students.html.twig', array('courses' => $course, 'students' => $course->getStudents()));
    // });

    return $app;
?>
