<?php
class StudentsCreate extends Controller {
    public function __construct() {
        
        $this->studentModel = $this->model('Student');
    }

    public function index() {
        $students = $this->studentModel->findAllStudents();
        $data = [
            'students' => $students
        ];
        
        $this->view('studentscreate/index', $data);
    }

    public function create() {
        if(!isLoggedIn()) {
            header("Location: " . URLROOT . "/studentsCreate");
        }

        $data = [
            'name' => '',
            'school_board_id' => '',
            'nameError' => '',
            'school_boardError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'school_board_id' => $_SESSION['school_board_id'],
                'name' => trim($_POST['name']),
                'nameError' => '',
                'school_boardError' => ''
            ];

            if(empty($data['school_board_id'])) {
                $data['school_boardError'] = 'The school_board of a post cannot be empty';
            }

            if(empty($data['name'])) {
                $data['nameError'] = 'The name of a post cannot be empty';
            }

            if (empty($data['school_boardError']) && empty($data['nameError'])) {
                if ($this->studentModel->addStudent($data)) {
                    header("Location: " . URLROOT . "/studentsCreate");
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->view('studentscreate/create', $data);
            }
        }

        $this->view('studentscreate/create', $data);
    }

    public function add_grades() {

        if(!isLoggedIn()) {
            header("Location: " . URLROOT . "/studentsCreate");
        }

        $data = [
            'student_id' => '',
            'grade1' => '',
            'grade2' => '',
            'grade3' => '',
            'grade4' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'student_id' => $_POST['student_id'],
                'grade1' => $_POST['grade1'],
                'grade2' => $_POST['grade2'],
                'grade3' => $_POST['grade3'],
                'grade4' => $_POST['grade4']
            ];

            if ($this->studentModel->addStudentGrades($data)) {
                header("Location: " . URLROOT . "/studentsCreate");
            } else {
                die("Something went wrong, please try again!");
            }
          
        }

        $this->view('studentscreate/index', $data);
    }
}

