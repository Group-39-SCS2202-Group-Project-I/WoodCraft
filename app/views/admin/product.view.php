<?php include "inc/header.view.php"; ?>

<!-- fetch and display data -->
<?php
$url = ROOT . "/fetch/product/" . $data['x'];
$response = file_get_contents($url);
$data = json_decode($response, true);
// show($data);
?>



<!DOCTYPE html>

<style>
    /* table */
    .list-section {
        margin: 0 auto;
        /* max-width: 800px; */
        padding: 20px;
        background-color: var(--light);
        border-radius: 10px;
        /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); */
        display: flex;
    }

    .list-section__title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        /* text-align: center; */
        color: var(--blk);
    }

    /* .product-container {
        display: flex;
    } */

    .flex-half {
        flex: 1;
        padding: 20px;
    }

    .carousel {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        overflow: hidden;
    }

    .carousel-left-btn,
    .carousel-right-btn {
        background-color: var(--light);

        border: none;
        padding: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }



    #carouselImages {
        flex-grow: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image-count {
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        margin-top: 10px;
    }
</style>

<html>

<body>
    <div class="list-section">
        <div class="flex-half">
            <section>
                <h1 class="list-section__title">Product Details</h1>
                <div class="product-details">
                    <!-- Product details will be populated here -->
                </div>
            </section>
            <section>
                <h1 class="list-section__title">Product Measurments</h1>
                <div>

                </div>
            </section>
        </div>
        <div class="flex-half">
            <h1 class="list-section__title">Product Images</h1>
            <div class="carousel">
                <button class="carousel-left-btn" id="prevBtn">
                    <span class="material-symbols-outlined">
                        arrow_back_ios
                    </span>
                </button>
                <div id="carouselImages">
                    <!-- Carousel images will be populated here -->
                </div>
                <button class="carousel-right-btn" id="nextBtn">
                    <span class="material-symbols-outlined">
                        arrow_forward_ios
                    </span>
                </button>
            </div>
            <!-- show number of images and current image like 4/5 -->
            <div class="image-count">4/5</div>
        </div>
        <script>
            window.onload = function() {
                var product = {
                    product_id: 1,
                    name: 'product1',
                    description: 'hehehe',
                    product_category_id: 2,
                    product_inventory_id: 1,
                    product_measurement_id: 1,
                    price: 40000.00,
                    created_at: '2023-12-23 14:26:05',
                    updated_at: '2023-12-23 14:41:38',
                    deleted_at: '',
                    category_name: 'fwddsd',
                    quantity: 0,
                    length: 23.00,
                    width: 43.00,
                    height: 34.00,
                    weight: 3.34
                };

                var productDetailsElement = document.querySelector('.product-details');

                var productDetails = [{
                        label: 'Name',
                        value: product.name
                    },
                    {
                        label: 'Description',
                        value: product.description
                    },
                    {
                        label: 'Category',
                        value: product.category_name
                    },
                    {
                        label: 'Quantity',
                        value: product.quantity
                    },
                    {
                        label: 'Length',
                        value: product.length
                    },
                    {
                        label: 'Width',
                        value: product.width
                    },
                    {
                        label: 'Height',
                        value: product.height
                    },
                    {
                        label: 'Weight',
                        value: product.weight
                    },
                    {
                        label: 'Price',
                        value: product.price
                    }
                ];

                productDetails.forEach(function(detail) {
                    var labelElement = document.createElement('label');
                    labelElement.innerHTML = detail.label;
                    productDetailsElement.appendChild(labelElement);

                    var valueElement = document.createElement('span');
                    valueElement.innerHTML = detail.value;
                    productDetailsElement.appendChild(valueElement);

                    var brElement = document.createElement('br');
                    productDetailsElement.appendChild(brElement);
                });



                var images = [{
                        image_id: 1,
                        product_id: 1,
                        image: '<?php echo ROOT ?>/public/assets/images/craft-1.png'
                    },
                    {
                        image_id: 2,
                        product_id: 1,
                        image: '<?php echo ROOT ?>/public/assets/images/craft-2.png'
                    },
                    {
                        image_id: 3,
                        product_id: 1,
                        image: '<?php echo ROOT ?>/public/assets/images/craft-3.png'
                    },
                    {
                        image_id: 4,
                        product_id: 1,
                        image: '<?php echo ROOT ?>/public/assets/images/craft-4.png'
                    },


                ];

                var carouselImages = images.map(function(image) {
                    return image.image;
                });


                var carouselImagesElement = document.querySelector('#carouselImages');
                var prevBtn = document.querySelector('#prevBtn');
                var nextBtn = document.querySelector('#nextBtn');

                var currentImageIndex = 0;

                function updateCarousel() {
                    carouselImagesElement.innerHTML = '';
                    var imageElement = document.createElement('img');
                    imageElement.src = carouselImages[currentImageIndex];
                    carouselImagesElement.appendChild(imageElement);
                }

                prevBtn.addEventListener('click', function() {
                    currentImageIndex--;
                    if (currentImageIndex < 0) {
                        currentImageIndex = carouselImages.length - 1;
                    }
                    updateCarousel();
                });

                nextBtn.addEventListener('click', function() {
                    currentImageIndex++;
                    if (currentImageIndex >= carouselImages.length) {
                        currentImageIndex = 0;
                    }
                    updateCarousel();
                });

                updateCarousel();
            };
        </script>
</body>

</html>




<?php include "inc/footer.view.php"; ?>