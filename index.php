<?php include "connect.php" ?>
<?php include "functions.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<style>
    body.modal-open .container {
        filter: blur(5px);
    }

    .mark {
        box-shadow: none;
    }
</style>

<body class="bg-light">
    <div class="modal fade" id="insertItem">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header fs-4 ">Add item</div>
                <div class="modal-body">
                    <form action="" method="post">
                        <textarea name="item" id="" cols="60" rows="5"></textarea>
                        <input type="submit" value="ASSIGN" name="submit" class="btn btn-dark w-100">
                    </form>
                    <?php
                    if (isset($_POST['submit'])) {
                        $itemArray = [
                            "item" => $_POST['item'],
                            "active" => 1
                        ];

                        insertItem('todo_list', $itemArray);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="card col-lg-10 mx-auto shadow-lg">
            <div class="card-header fs-3">To-Do Lists Here...
                <button type="button" class="btn-dark float-end rounded-pill fs-5 px-3 py-1" data-bs-target="#insertItem" data-bs-toggle="modal">Add Item</button>
            </div>

            <div class="card-body">

                <div class="d-flex">
                    <!-- <div class="btn-group"> -->
                        <form action="" method="post">
                            <button class="btn btn-success rounded-pill ms-2" name="all">All Lists</button>
                        </form>
                        <form action="" method="post">
                            <button class="btn btn-primary rounded-pill ms-2" name="active">Active Lists</button>
                        </form>
                        <form action="" method="post">
                            <button class="btn btn-danger rounded-pill ms-2" name="inactive">Inactive Lists</button>
                        </form>
                    <!-- </div> -->
                </div>

                <table class="table mt-4">
                    <tr>
                        <th>Action Switch</th>
                        <th>ID</th>
                        <th>To-Do List</th>
                        <th>Active</th>
                    </tr>

                    <?php
                    if(isset($_POST['all'])) {
                        $lists = showItem("todo_list");
                    } elseif (isset($_POST['active'])) {
                        $lists = showItem("todo_list where todo_list.active=1");
                    } elseif (isset($_POST['inactive'])) {
                        $lists = showItem("todo_list where todo_list.active=0");
                    } else {
                        $lists = showItem("todo_list");
                    }
                    foreach ($lists as $item) {
                    ?>
                        <tr class="
                        <?php 
                            if($item['active']==0){
                                echo "bg-light";
                            }
                        ?>
                        ">
                            <?php if ($item['active'] == 1) { ?>
                                <td><a href="index.php?id_done=<?= $item['id']; ?>" class="btn p-0 fs-4 ps-2"><i class="bi bi-toggle-off"></i></a></td>
                                <?php
                                if (isset($_GET['id_done'])) {
                                    $id = $_GET['id_done'];
                                    updateActivity("todo_list", $id, 0);
                                }
                                ?>
                            <?php } else { ?>
                                <td><a href="index.php?id_undo=<?= $item['id'] ?>" class="btn p-0 fs-4 ps-2"><i class="bi bi-toggle-on"></i></a></td>
                            <?php
                                if (isset($_GET['id_undo'])) {
                                    $id = $_GET['id_undo'];
                                    updateActivity("todo_list", $id, 1);
                                }
                            }
                            ?>
                            <td class="fs-5 fw-light"><?= $item['id'] ?></td>
                            <td class="fs-5 fw-light
                            <?php
                            if ($item['active'] == 0) {
                                echo "text-decoration-line-through text-muted";
                            }
                            ?>
                            "><?= $item['item'] ?></td>
                            <?php
                            if ($item['active'] == 1) {
                            ?>
                                <td><span class=" rounded-pill badge bg-primary">Incomplete</span></td>

                            <?php } else { ?>
                                <td><span class=" rounded-pill badge bg-danger">Completed</span></td>
                        </tr>
                        <?php
                                if (isset($_POST['done'])) {
                                    $id = $item['id'];
                                    updateActivity("todo_list", $id, 0);
                                }
                        ?>
                <?php }
                        } ?>
                </table>



            </div>
        </div>
    </div>





    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>