<?php
    require __DIR__ . '/config/constants.php';

    require __DIR__ . '/partials-front/menu.php'; 
?>


    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                $cursor = $db->col_category->find([
                    'active' => 'Yes'
                ]);

                if(count($cursor->toArray()) > 0):
                    $cursor = $db->col_category->find([
                        'active' => 'Yes'
                    ]);
                    foreach ($cursor as $data):
            ?>      
                        <a href="./category-foods.php?category_id=<?php echo strval($data['_id']);?>">
                        <div class="box-3 float-container">
                            <?php  
                                if ($data['image_name']==""):
                                    echo "<div class='error'>Category Not Found</div>";
                                else:
                            ?>
                                    <img src="./images/category/<?php echo $data['image_name']; ?>" alt="Pizza" class="img-responsive img-curve">
                            <?php
                                endif;
                            ?>
                            <h3 class="float-text text-white"><?php echo $data['title']; ?></h3>
                        </div>
                        </a>
            <?php
                    endforeach;
                else:
                    echo "<div class='error'>Category Not Found</div>";
                endif;
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

<?php require __DIR__ . '/partials-front/footer.php'; ?>