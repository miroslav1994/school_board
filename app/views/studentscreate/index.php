<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="navbar dark">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container">
    <?php if(isLoggedIn()): ?>
        <a class="btn green" href="<?php echo URLROOT; ?>/studentsCreate/create">
            Create
        </a>
    <?php endif; ?>

    <?php foreach($data['students'] as $student): ?>
        <div class="container-item">
            <h2>
                <?php echo $student->name; ?>
            </h2>
            
            <form action="<?php echo URLROOT; ?>/studentsCreate/add_grades" method="POST">
                <input type="hidden" id="student_id" name="student_id" value="<?= $student->id; ?>">
                <div class="form-item">
                
                    <input type="numeric" name="grade1">
                    <input type="numeric" name="grade2">
                    <input type="numeric" name="grade3">
                    <input type="numeric" name="grade4">
                </div>

                <button class="btn green" name="submit" type="submit">Submit</button>
            </form>
            
        </div>
    <?php endforeach; ?>
</div>
