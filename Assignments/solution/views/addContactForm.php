<?php
require __DIR__ . '/../includes/navigation.php';
?>
<div class="container mt-4">
    <h2>Add Contact</h2>
    <?php if (isset($message)) echo "<p class='text-info'>$message</p>"; ?>
    <form method="post" action="controllers/addContactProc.php">
        <div class="mb-3">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="fname" name="fname" required>
        </div>
        <div class="mb-3">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lname" name="lname" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city" required>
        </div>
       <div class="mb-3">
            <label for="state" class="form-label">State</label>
            <input type="text" class="form-control" id="state" name="state" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="123.456.7890" required>
        </div>                                                             <div class="mb-3">
            <label for="email" class="form-label">Email</label>                <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="text" class="form-control" id="dob" name="dob" placeholder="mm/dd/yyyy" required>
        </div>

        <!-- Age range selection -->
        <div class="mb-3">
            <label class="form-label">Age Range</label><br>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="age" id="age1" value="0-17">
                <label class="form-check-label" for="age1">0-17</label>
            </div>
            <div class="form-check">                                               <input class="form-check-input" type="radio" name="age" id="age2" value="18-30">
                <label class="form-check-label" for="age2">18-30</label>
            </div>                                                             <div class="form-check">
                <input class="form-check-input" type="radio" name="age" id="age3" value="30-50">
                <label class="form-check-label" for="age3">30-50</label>                                                                          </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="age" id="age4" value="50+">                                                      
                <label class="form-check-label" for="age4">50+</label>                                                                           
            </div>
          </div>                                                     
        <!-- Select one or more options -->                                <div class="mb-3">
            <label class="form-label">Select one or more options:</label><br>
            <div class="form-check">                                               <input class="form-check-input" type="checkbox" name="options[]" id="opt1" value="newsletter">                                        <label class="form-check-label" for="opt1">Newsletter</label>
            </div>
            <div class="form-check">                                               <input class="form-check-input" type="checkbox" name="options[]" id="opt2" value="email">
                <label class="form-check-label" for="opt2">Email</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="options[]" id="opt3" value="text">
                <label class="form-check-label" for="opt3">Text</label>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Add Contact</button>
    </form>
</div>
       
