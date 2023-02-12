<?php require ('inc/header.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center display-4 border my-5 p2"> All Users </h1>
        </div>
        <div class="col-sm-10 mx-auto">
            <div class="border my-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        include 'Classes/user.php';
                        $i=1;
                        ?>
                        <?php foreach(User::getAllUsers() as $row): ?>
                        <tr>
                            <th scope="row" ><?php echo $i++ ?></th>
                            <td> <?php echo $row->name; ?> </td>
                            <td> <?php echo $row->email;?> </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include ('inc/footer.php'); ?>