<?php
class Student {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function findAllStudents() {
        $school_board_id = $_SESSION['school_board_id'];
        $where = " WHERE school_board_id = $school_board_id ";

        $this->db->query('SELECT * FROM public.students ' .  $where . ' ORDER BY name');

        $results = $this->db->resultSet();

        return $results;
    }

    public function addStudent($data) {
        $this->db->query('INSERT INTO public.students (name, school_board_id) VALUES (:name, :school_board_id)');

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':school_board_id', $data['school_board_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addStudentGrades($data) { 

        for($i = 1;$i <= 4; $i++) {
            if(!empty($data['grade' . $i])) {
                $this->db->query('INSERT INTO public.student_grades (student_id, grade) VALUES (:student_id, :grade)');
                $this->db->bind(':student_id', $data['student_id']);
                $this->db->bind(':grade', $data['grade' . $i]);

               $this->db->execute();
              
            }
        }
        return true;
    }

    public function findStudentById($id) {
        $this->db->query('SELECT * FROM public.students WHERE id = :id');

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function findAverageGrades($id) {
        $this->db->query('SELECT avg(grade) average FROM public.student_grades WHERE student_id = :id');

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function findMaxGrade($id) {
        $this->db->query('SELECT max(grade) max FROM public.student_grades WHERE student_id = :id');

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function findGrades($id) {
        $this->db->query('SELECT grade FROM public.student_grades WHERE student_id = :id');

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }
}
