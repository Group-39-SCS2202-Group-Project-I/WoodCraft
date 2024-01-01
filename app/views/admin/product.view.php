<?php include "inc/header.view.php"; ?>

<!-- fetch and display data -->
<?php
$url = ROOT . "/fetch/product/" . $data['x'];
$response = file_get_contents($url);
$data = json_decode($response, true);
// show($data['product_id']);
// show($data);
?>



<?php if (message()) : ?>
    <div class="mzg-box">
        <div class="messege"><?= message('', true) ?></div>
    </div>
<?php endif; ?>



<div class="list-section">
    <div class="flex-half">
        <section>

            <div class="table-section">
                <div style=" text-align: right;">
                    <a href="<?php echo ROOT ?>/admin/products/update/<?= $data['product_id'] ?>" class="table-section__add-link">Update Product Details</a>
                    <a onclick="openDeletePopup(<?= $data['product_id'] ?>)" class="table-section__add-link">Delete Product</a>
                </div>
            </div>
            <h1 class="list-section__title">Product Details </span></h1>

            <div class="product-details">
                <div class="detail-item">
                    <label>Product ID : </label>
                    <span><?php echo sprintf('PRD-%03d', $data['product_id']) ?></span>
                </div>
                <div class="detail-item">
                    <label>Name : </label>
                    <span><?php echo $data['name'] ?></span>
                </div>
                <div class="detail-item">
                    <label style="width:100%">Description : </label>

                    <span><?php echo $data['description'] ?></span>
                </div>
                <div class="detail-item">
                    <label>Category : </label>
                    <span><?php echo $data['category_name'] ?></span>
                </div>
                <div class="detail-item">
                    <label>Stocks Available : </label>
                    <span><?php echo $data['quantity'] ?></span>
                </div>
                <div class="detail-item">
                    <label>Price : </label>
                    <span><?php echo $data['price'] ?></span>
                </div>
            </div>
        </section>
        <section>

            <h1 class="list-section__title" style="margin-top: 30px;">Product Measurments</h1>
            <div>
                <div class="detail-item">
                    <label class="item-label">Height : </label>
                    <span class="item-val"><?php echo $data['height'] ?> cm</span>
                </div>
                <div class="detail-item">
                    <label>Width : </label>
                    <span><?php echo $data['width'] ?> cm</span>
                </div>
                <div class="detail-item">
                    <label>Length : </label>
                    <span><?php echo $data['length'] ?> cm</span>
                </div>
                <div class="detail-item">
                    <label>Weight : </label>
                    <span><?php echo $data['weight'] ?> kg</span>
                </div>


            </div>
        </section>
    </div>



    <div class="flex-half">
        <div class="table-section">
            <div style="text-align: right;">
                <a href="#" class="table-section__add-link" onclick="toggleImageForm()">Add Product Image</a>
            </div>
            <div id="imageForm" style="display: none;" class="center-items">
                <form action="<?php echo ROOT ?>/add/product_image" method="post" enctype="multipart/form-data">
                    <div id="drop_zone">Drag and drop your image here, or click to select image</div>
                    <img id="preview" style="display: block; margin: 0 auto; margin-bottom:0.8rem; background-color:white; border-radius:10px;">
                    <input name="image" type="file" id="file_input" style="display: none;" accept="image/*">
                    <input name="product_id" type="hidden" id="product_id" value="<?php echo $data['product_id'] ?>">
                    <button class="form-btn submit-btn" style="width: 50%;">Upload</button>
                </form>
            </div>
        </div>

        <script>
            function toggleImageForm() {
                var x = document.getElementById("imageForm");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }

            let dropZone = document.getElementById('drop_zone');
            let fileInput = document.getElementById('file_input');
            let preview = document.getElementById('preview');

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            function handleFiles(files) {
                ([...files]).forEach(uploadFile);
            }

            function uploadFile(file) {
                let reader = new FileReader();
                reader.onloadend = function() {
                    preview.src = reader.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }

            fileInput.addEventListener('change', function(e) {
                handleFiles(this.files);
            }, false);

            // Event listeners for file drop
            dropZone.addEventListener('drop', function(e) {
                let dt = e.dataTransfer;
                let files = dt.files;

                handleFiles(files);
            }, false);

            // Event listener for drop zone click to trigger file input click
            dropZone.addEventListener('click', function() {
                fileInput.click();
            }, false);
        </script>
        <h1 class="list-section__title">Product Images</h1>
        <!-- fetch product images -->
        <?php
        $url = ROOT . "/fetch/product_images/" . $data['product_id'];
        $response = file_get_contents($url);
        $images = json_decode($response, true);
        // show($images);

        ?>
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
        <div style="text-align: center;">
            <a onclick="deleteImage()">
                <span class="material-symbols-outlined delete-image-btn">
                    delete
                </span>
            </a>

        </div>

        <div class="image-count"></div>


    </div>
    <script>
        const carouselImages = document.getElementById('carouselImages');
        const imageCount = document.querySelector('.image-count');

        let images = <?php echo json_encode($images) ?>;
        let currentImage = 0;

        images.forEach(image => {
            carouselImages.innerHTML += `
                <img src="<?php echo ROOT . '/' ?>${image.image_url}" alt="Product Image-${image.product_image_id}" class="carousel-image">
            `;
        });

        imageCount.innerHTML = `${currentImage + 1}/${images.length}`;



        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        // Add event listeners to carousel buttons
        prevBtn.addEventListener('click', () => {
            // Decrease currentImage index
            currentImage--;
            // If currentImage is less than 0, set it to the last image
            if (currentImage < 0) {
                currentImage = images.length - 1;
            }
            updateCarousel();
        });

        nextBtn.addEventListener('click', () => {
            currentImage++;
            if (currentImage >= images.length) {
                currentImage = 0;
            }
            updateCarousel();
        });

        function updateCarousel() {

            carouselImages.innerHTML = '';
            carouselImages.innerHTML += `
        <img src="<?php echo ROOT . '/' ?>${images[currentImage].image_url}" alt="Product Image-${images[currentImage].product_image_id}" class="carousel-image">
    `;
            // Update image count
            imageCount.innerHTML = `${currentImage + 1}/${images.length}`;
        }

        // Initial carousel update
        updateCarousel();

        // Delete image
        function deleteImage() {
            // Get image id
            let imageId = images[currentImage].product_image_id;
            console.log(imageId);
            // Send delete request
            let xhr = new XMLHttpRequest();
            xhr.open('DELETE', '<?php echo ROOT . '/delete/product_images/' ?>' + imageId, true);
            xhr.onload = function() {
                if (this.status == 200) {
                    // Reload page
                    location.reload();
                }
            }
            xhr.send();
        }
    </script>
</div>

<div class="popup-form" id="delete-item-popup">
    <div class="popup-form__content">
        <form action="" method="POST" class="form">
            <!-- <h2 class="popup-form-title">Delete Item</h2> -->
            <!-- <p>Are you sure you want to delete this item?</p> -->
            <p class="confirmation-text">Are you sure you want to delete </p>

            <div class="form-group frm-btns">
                <button type="submit" class="form-btn submit-btn">Yes</button>
                <button type="button" class="form-btn cancel-btn" onclick="closePopup()">No</button>
            </div>
        </form>
    </div>
</div>

<script>
    openDeletePopup = (id) => {
        const popup = document.getElementById('delete-item-popup');
        const confirmationText = document.querySelector('.confirmation-text');
        x = "PRD-" + String(id).padStart(3, '0');
        confirmationText.innerHTML += "Product ID: " + x + "?";
        popup.classList.add('popup-form--open');
        popup.querySelector('form').action = "<?php echo ROOT ?>/delete/products/" + id;
        // console.log(id);
    }

    function closePopup() {
        const popups = document.querySelectorAll('.popup-form');
        confirmText = document.querySelector('.confirmation-text');
        confirmText.innerHTML = "Are you sure you want to delete ";
        popups.forEach(popup => {
            popup.classList.remove('popup-form--open');
        });

    }
</script>







<?php include "inc/footer.view.php"; ?>