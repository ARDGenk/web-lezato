<?php
    require __DIR__ . '/config/constants.php';

    require __DIR__ . '/partials-front/menu.php'; 
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <?php  
                // $search = $_POST['search'];
                $search = $_POST['search'];
            ?>
            <h2>Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $cursor = $db->col_food->find([
                    '$or' => [
                        [ 'title' => ['$regex' => '.*' . $search . '.*', '$options' => 'i']],
                        ['description' => ['$regex' => '.*' . $search . '.*', '$options' => 'i']]
                    ]
                ]);

                // print_r($cursor->toArray());

                $count = count($cursor->toArray());

                if($count>0):
                    $cursor = $db->col_food->find([
                        '$or' => [
                            [ 'title' => ['$regex' => '.*' . $search . '.*', '$options' => 'i']],
                            ['description' => ['$regex' => '.*' . $search . '.*', '$options' => 'i']]
                        ]
                    ]);
                    foreach ($cursor as $data):
            ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php  
                                    if($data['image_name']==""):
                                        echo "<div class='error'>Image not Available</div>";
                                    else:
                                ?>
                                        <img src="./images/food/<?php echo $data['image_name']; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                                    endif;
                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $data['title']; ?></h4>
                                <p class="food-price"><?php echo $data['price']; ?></p>
                                <p class="food-detail">
                                    <?php echo $data['description']; ?>
                                </p>
                                <br>

                                <a href="#" class="btn btn-primary">WA CUY</a>
                            </div>
                        </div>
            
            <?php
                    endforeach;
                else:
                    echo "<div class='error'>Food not found</div>";
                endif;
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php require __DIR__ . '/partials-front/footer.php';  ?>