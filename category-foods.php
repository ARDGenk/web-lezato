<?php
    require __DIR__ . '/config/constants.php';

    require __DIR__ . '/partials-front/menu.php'; 

    use MongoDB\BSON\ObjectId;
?>

    <?php  
        if(isset($_GET['category_id']))
        {
            $category_id = new ObjectId($_GET['category_id']);
            
            $cursor = $db->col_category->findOne([
                '_id' => $category_id
            ]);

            $category_title = $cursor['title'];
        }
        else
        {
            header('location: ./');
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            
            <?php  
                $cursor = $db->col_food->find([
                    'category_id' => strval($category_id)
                ]);

                if(count($cursor->toArray()) > 0):
                     $cursor = $db->col_food->find([
                        'category_id' => strval($category_id)
                    ]);

                    foreach ($cursor as $data):
            ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php  
                                    if($data['image_name']==""):
                                        echo "<div class='error'>Image Not Available</div>";
                                    else:
                                ?>
                                        <img src="./images/food/<?php echo $data['image_name'];?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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
                                
                                <a href="#">WA CUY</a>
                            </div>
                        </div>
            <?php
                    endforeach;
                else:
                    echo "<div class='error'>Food Not Available</div>";
                endif;
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Food Menu Section Ends Here -->

<?php require __DIR__ . '/partials-front/footer.php'; ?>