<?php
class Students extends Controller {
    public function __construct() {
        $this->studentModel = $this->model('Student');
    }

    public function arrayToXml($array, &$xml){
        foreach ($array as $key => $value) {
            if(is_array($value)){
                if(is_int($key)){
                    $key = "e";
                }
                $label = $xml->addChild($key);
                $this->arrayToXml($value, $label);
            }
            else {
                $xml->addChild($key, $value);
            }
        }
    }

    public function index() {
        $students = $this->studentModel->findAllStudents();
        $data = array();
        
        for($i = 0;$i < count($students); $i++) {
            //find avg
            $avg = $this->studentModel->findAverageGrades($students[$i]->id);
            $max = $this->studentModel->findMaxGrade($students[$i]->id);
            $students_grades = $this->studentModel->findGrades($students[$i]->id);

            //CSM
            $average = floatval ($avg->average);
            if($_SESSION['school_board_id'] == 1) {
                if($average >= 7) $status = "PASS";
                else $status = "FAIL";
            } else {
                $max_grade = floatval ($max->max);
                if($max_grade > 8) $status = "PASS";
                else $status = "FAIL";
            }
            
            $data[$i] = (object) array("id" => $students[$i]->id, "name" => $students[$i]->name, "avg_grade" => $average, "students_grades" => $students_grades, "status" => $status);
        }
        if($_SESSION['school_board_id'] == 1) {
            $result = json_encode($data);
            echo $result;
        } else {
            $result = json_encode($data);
            $result = json_decode($result, true);
            $xml = new SimpleXMLElement('<root/>');
            $this->arrayToXml($result, $xml);
        }

    }
}

