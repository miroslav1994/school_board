<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="navbar dark">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container center">
    <h1>
        Create new student
    </h1>
    
    <form action="<?php echo URLROOT; ?>/studentsCreate/create" method="POST">
        <div class="form-item">
            <input type="text" name="name" placeholder="Name...">

            <span class="invalidFeedback">
                <?php echo $data['nameError']; ?>
            </span>
            <span class="invalidFeedback">
                <?php echo $data['school_boardError']; ?>
            </span>
        </div>

        <button class="btn green" name="submit" type="submit">Submit</button>
    </form>
</div>
