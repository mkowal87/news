<?php
include_once('src/Controller/UserController.php');
include_once('src/Model/UserModel.php');
include_once('src/Controller/NewsesController.php');


$newsesController = new \App\Controller\NewsesController();
$newses = $newsesController->getActiveNewses();

if (isset($_POST['register'])) {

    $userController = new \App\Controller\UserController();
    if ($userController->isUserExist($_POST['email'])){
        $register_info = 'User with that email already exist';
    }else {
        if ($userController->registerUser()) {
            $register_info = 'Your account has been created';
        }
    }

}

if (isset($_POST['login'])) {
    session_start();
    $userController = new \App\Controller\UserController();
    if ($userController->loginUser()){
        header('Location:/');
    }else {
        $register_info = 'Failed to login, wrong password';
    }

}
?>

<script type="text/javascript">
    function showHide(id) {
        var x = document.getElementById("showHide");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
<button class="btn btn-success" onclick="showHide()">Login/Register</button>
<div style="display: none" id="showHide">
    <div class="col-xs-6" style="float: left">
        <form class="form-horizontal" action='' method="POST">
            <fieldset>
                <div id="legend">
                    <legend class="">Register</legend>
                </div>
                <div class="control-group">
                    
                    <label class="control-label"  for="username">First Name</label>
                    <div class="controls">
                        <input type="text" id="first_name" name="first_name" placeholder="" class="input-xlarge" required minlength="3" maxlength="20">
                        <p class="help-block">First name can contain any letters, without spaces</p>
                    </div>
                </div>

                <div class="control-group">

                    <label class="control-label"  for="username">Last Name</label>
                    <div class="controls">
                        <input type="text" id="last_name" name="last_name" placeholder="" class="input-xlarge" required minlength="3" maxlength="20">
                        <p class="help-block">Last name can contain any letters, without spaces</p>
                    </div>
                </div>

                <div class="control-group">

                    <label class="control-label"  for="username">Gender</label>
                    <div class="controls">
                        <select id="gender" name="gender" placeholder="" class="input-xlarge">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <p class="help-block">Gender can be selected from male and female</p>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="email">E-mail</label>
                    <div class="controls">
                        <input type="email" id="email" name="email" placeholder="" class="input-xlarge">
                        <p class="help-block">Please provide your E-mail</p>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="password">Password</label>
                    <div class="controls">
                        <input type="password" id="password_1" name="password" placeholder="" class="input-xlarge" required minlength="3" maxlength="20">
                        <p class="help-block">Password should be at least 3 characters</p>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <input type="submit" name="register" class="btn btn-success" value="Register">
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <div class="col-xs-6">
        <form class="form-horizontal" action='' method="POST">
            <fieldset>
                <div id="legend">
                    <legend class="">Login</legend>
                </div>

                <div class="control-group">
                    <!-- E-mail -->
                    <label class="control-label" for="email">E-mail</label>
                    <div class="controls">
                        <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
                        <p class="help-block">Please provide your E-mail</p>
                    </div>
                </div>

                <div class="control-group">
                    <!-- Password 1-->
                    <label class="control-label" for="password">Password</label>
                    <div class="controls">
                        <input type="password" id="password_1" name="password" placeholder="" class="input-xlarge">
                        <p class="help-block">Password should be at least 3 characters</p>
                    </div>
                </div>

                <div class="control-group">
                    <!-- Button -->
                    <div class="controls">
                        <input type="submit" name="login" class="btn btn-success" value="Login">
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<P><?php echo $register_info;?></P>
<div class="container">
    <div class="row">
        <table class="table table-hover table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Is Active</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
            </thead>
            <tbody>
            <?php


            $i = 0;
            foreach ($newses as $id => $news){

                ?>

                <tr id="desc<?php echo $news['id']?>">
                    <td><?php echo $news['id']?></td>
                    <td id="desc_name"><?php echo $news['name']; ?></td>
                    <td id="desc_desc"><?php echo $news['description']; ?></td>
                    <td id="desc_is_active"><?php echo $news['is_active']; ?></td>
                    <td id="desc_created"><?php echo $news['created_at']; ?></td>
                    <td id="desc_updated"><?php echo $news['updated_at']; ?></td>
                </tr>


                <?php $i++; } ?>
            </tbody>
        </table>
    </div>
</div>
</div>