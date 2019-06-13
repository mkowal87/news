<?php
include_once('src/Controller/NewsesController.php');
include_once('src/Controller/UserController.php');

if(isset($_SESSION["login"]) && $_SESSION["login"] === true){

    $newsesController = new \App\Controller\NewsesController();
    $newses = $newsesController->getAllNewses();

    if (isset($_POST['delete'])) {
        $newsesController->deleteNews($_POST['descId']);
        header('Location:/');
    }

    if (isset($_POST['edit'])) {
        $newsesController->editNews();
        header('Location:/');
    }

    if (isset($_POST['add_news'])) {
        $newsesController->addNews();
        header('Location:/');
    }

    if (isset($_POST['logout']))
    {
        \App\Controller\UserController::logout();
        header('Location:/');
    }
    ?>

    <script type="text/javascript">
        function showHideAddNews() {
            var x = document.getElementById("createNews");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function showHideEdit(id) {
            var x = document.getElementsByClassName("editNews"+id);
            for (var i = 0; i < x.length; i++) {

                if (x[i].style.display === "none") {
                    x[i].style.display = "block";
                } else {
                    x[i].style.display = "none";
                }
            }
        }
    </script>
    <div class="col-xs-10">
        <div class="col-xs-8">
            <button class="btn btn-success" onclick="showHideAddNews()">Create News</button>
            <div class="col-xs-8" style="float: right;">
                <span>You are loged in as: <?php echo $_SESSION['first_name']?> <?php echo $_SESSION['last_name']?> </span>
                <form action="" method="POST">

                    <input type="submit" name="logout" class="btn btn-default" value="Logout">
                </form>
            </div>
        </div>
        <div class="container" id="createNews" style="display: none">
            <div class="row">

                <div class="col-md-8 col-md-offset-2">

                    <h1>Create post</h1>

                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="news">News name</label>
                            <input type="text" class="form-control" id="name" name="name" required minlength="3" maxlength="20"/>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea rows="5" class="form-control" name="description" id="description"  required minlength="3" maxlength="2000"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="is_active">Is Active</label>
                            <select id="is_active" name="is_active" placeholder="" class="input-xlarge">
                                <option value="1">true</option>
                                <option value="0">false</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="add_news" class="btn btn-default" value="Add News">
                        </div>

                    </form>
                </div>

            </div>
        </div>

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
                        <th>Author</th>
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
                        <td id="desc_author"><?php echo $news['author_id']; ?></td>


                        <td>

                            <button type="button" class="btn btn-warning btn-sm" onclick="showHideEdit(<?php echo $news['id']?>)"> Edit </button>

                        </td>
                            <td>

                                <form action="" method="POST">
                                    <input type="text" class="form-control" id="descId" name="descId"
                                           value="<?php echo $news['id']?>" style="display: none;"/>
                                    <input type="submit" name="delete" class="btn btn-danger btn-sm" value="Delete">
                                </form>
                            </td>
                    </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" id="editId<?php echo $news['id']?>" name="editId<?php echo $news['id']?>"
                                           value="<?php echo $news['id']?>" style="display: none;" form="editForm<?php echo $news['id']?>"/>
                                </td>
                                <td>
                                    <input type="text" class="form-control editNews<?php echo $news['id']?>" id="editName<?php echo $news['id']?>" name="editName<?php echo $news['id']?>"
                                           value="<?php echo $news['name']?>" form="editForm<?php echo $news['id']?>" style="display: none;"/>
                                </td>
                                <td>
                                    <input type="text" class="form-control editNews<?php echo $news['id']?>" id="editDescription<?php echo $news['id']?>" name="editDescription<?php echo $news['id']?>"
                                           value="<?php echo $news['description']?>" form="editForm<?php echo $news['id']?>" style="display: none;"/>
                                </td>
                                <td>
                                    <select form="editForm<?php echo $news['id']?>" id="editIsActive<?php echo $news['id']?>" name="editIsActive<?php echo $news['id']?>" placeholder="" class="input-xlarge editNews<?php echo $news['id']?>" style="display: none;"/>
                                        <option value="1">true</option>
                                        <option value="0">false</option>
                                    </select>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <form action="" method="POST" id="editForm<?php echo $news['id']?>">
                                        <input type="submit" name="edit" style="display: none;"
                                               class="btn btn-default btn-sm editNews<?php echo $news['id']?>" value="Save">
                                    </form>
                                </td>
                                <td>

                                </td>
                            </tr>


                    <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
} else {
    ?>
    <strong>You have no permission to be here, leave and never come back</strong>
    <?php
}
?>
