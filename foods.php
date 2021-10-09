<?php
    require __DIR__ . '/config/constants.php';

    require __DIR__ . '/partials-front/menu.php'; 
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="./food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $cursor = $db->col_food->find([
                    'active' => 'Yes'
                ]);

                if(count($cursor->toArray()) > 0):
                    $cursor = $db->col_food->find([
                        'active' => 'Yes'
                    ]);
                    foreach ($cursor as $data):
            ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php  
                                    if($data['image_name'] == ""):
                                        echo "<div class='error'>Image Not Available</div>";
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
                                <!-- <a href="./order.php?food_id=<?php echo strval($data['_id']); ?>" class="btn btn-primary">Order Now</a> -->
                                <a href="#">WA CUY</a>
                            </div>
                        </div>

            <?php
                    endforeach;
                else:
                    echo "<div class='error'>Image Not Available</div>";
                endif;
            ?>
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>