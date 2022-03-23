<?php
require_once '../crud/php/Component.php';
require_once '../crud/php/Operations.php';
?>

<?php
//instantiate the component class
$component = new Component();
//instantiate the database class
$db = new Database();
$conn = $db->connect();
//instantiate the Operations class
$operation = new Operations($conn,$component);
//call the createData function
$operation->createData();
//call the updateData function
$operation->updateData();
//call Delete function
$operation->deleteData();
//call Delete all function
$operation->deleteAll();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--Custom stylesheet-->
    <link rel="stylesheet" href="style4.css">
</head>

<body>
<main>
    <div class="container text-center">
        <h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-swatchbook"></i> Book Store</h1>
        <div class="d-flex justify-content-center">
            <form action="" method="post"  class="w-50">
              <div class="py-2">
                  <!--id input text-->
                  <?php echo $component->createInputComponent('fas fa-id-card','Id',
                      'id','','id')?>
              </div>
                <div class="pt-2">
                    <!--Book Name input-->
                    <?php echo $component->createInputComponent('fad fa-book-user','BookName',
                        'book_name','','Username')?>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <!--Publisher input-->
                        <?php echo $component->createInputComponent('fas fa-upload','Publisher',
                            'publisher','','Publisher'); ?>
                    </div>
                    <div class="col">
                        <!-- Price Input-->
                        <?php echo $component->createInputComponent('fas fa-dollar-sign','Price',
                            'price','','Price'); ?>
                    </div>
                </div>
                <div class="d-flex justify-content-center ">
                    <!-- Create Button-->
                    <?php echo $component->createButton('btn-create','btn btn-success',
                        'Create','create',"dat-toggle='tooltip' data-placement='bottom' title='Create",'<i class="far fa-plus-circle"></i>') ?>
                    <!--Read Button-->
                    <?php echo $component->createButton('btn-read','btn btn-primary',
                        'Read','read',"dat-toggle='tooltip' data-placement='bottom' title='Read",'<i class="far fa-sync"></i>') ?>
                    <!--Update Button-->
                    <?php echo $component->createButton('btn-update','btn btn-light border',
                        'Update','update',"dat-toggle='tooltip' data-placement='bottom' title='Update",'<i class="far fa-pen-alt"></i>') ?>
                    <!--Delete Button-->
                    <?php echo $component->createButton('btn-delete','btn btn-danger',
                    'Delete','delete',"dat-toggle='tooltip' data-placement='bottom' title='Delete",'<i class="fas fa-trash-alt"></i>') ?>
                    <?php  $operation->ShowDeleteBtn();?>
                </div>
            </form>
        </div>

            <!-- Bootstrap table -->
            <div class="d-flex table-data">
                <table class="table table-striped table-dark">
                    <!--Table Head-->
                    <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Book Name</th>
                        <th>Publisher</th>
                        <th>Book Price</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <!--Table Body-->
                    <tbody id="tbody">
                    <?php

                        if(isset($_POST['read']))
                        {
                            //call the readData function
                            $result = $operation->readData();
                            //count rows
                            $num = $result->rowCount();
                            if($num > 0)
                            {
                                //fetch the rows
                                while ($row = $result->fetch()){?>

                                    <tr>
                                        <td data-id="<?php echo $row['id']?>"><?php echo $row['id'];?></td>
                                        <td data-id="<?php echo $row['id']?>"><?php echo $row['book_name'];?></td>
                                        <td data-id="<?php echo $row['id']?>"><?php echo $row['book_publisher'];?></td>
                                        <td data-id="<?php echo $row['id']?>"><?php echo '$'. $row['book_price']?></td>
                                        <td><i data-id="<?php echo $row['id']?>" class="fas fa-edit btnedit"></i></td>
                                    </tr>

                                    <?php
                                }
                            }
                        }
                    ?>
                    </tbody>

                </table>
            </div>

        </div>
</main>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


<script src="../crud/JS/main.js"></script>

</body>
</html>