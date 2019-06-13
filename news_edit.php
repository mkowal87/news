<?php
include_once('src/Controller/NewsesController.php');

if(isset($_SESSION["login"]) && $_SESSION["login"] === true){

    $newsesController = new \App\Controller\NewsesController();
    $newses = $newsesController->getAllNewses();


    if (isset($_POST['edit'])) {
        include('news_edit.php');
    }

    if (isset($_POST['add_news'])) {
        $newsesController->addNews();
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

    </script>
    <div class="col-xs-10">
        <div class="col-xs-8">
            <button class="btn btn-success" onclick="showHideAddNews()">Create News</button>
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
                                <option value="true">true</option>
                                <option value="false">false</option>
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
                            <td id="desc_name" contenteditable="true" ><?php echo $news['name']; ?></td>
                            <td id="desc_desc" contenteditable="true" ><?php echo $news['description']; ?></td>
                            <td id="desc_is_active"><?php echo $news['is_active']; ?></td>
                            <td id="desc_created"><?php echo $news['created']; ?></td>
                            <td id="desc_updated"><?php echo $news['updated']; ?></td>
                            <td id="desc_author"><?php echo $news['author_id']; ?></td>


                            <td>
                                <form action="" method="POST">
                                    <input type="text" class="form-control" id="editId" name="editId"
                                           value="<?php echo $news['id']?>" style="display: none;"/>
                                    <input type="text" class="form-control" id="editId" name="editName"
                                           value="<?php echo $news['name']?>" style="display: none;"/>
                                    <input type="text" class="form-control" id="editId" name="editDescription"
                                           value="<?php echo $news['description']?>" style="display: none;"/>
                                    <input type="text" class="form-control" id="editId" name="editIsActive"
                                           value="<?php echo $news['is_active']?>" style="display: none;"/>
                                    <input type="submit" name="edit" class="btn btn-warning btn-sm" value="Edit">
                                </form>
                            </td>
                            <td>

                                <form action="" method="POST">
                                    <input type="text" class="form-control" id="descId" name="descId"
                                           value="<?php echo $news['id']?>" style="display: none;"/>
                                    <input type="submit" name="delete" class="btn btn-danger btn-sm" value="Delete">
                                </form>
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
