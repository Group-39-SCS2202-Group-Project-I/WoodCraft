<?php include "inc/header.view.php"; ?>

<!-- fetch and display data -->
<?php
$url = ROOT . "/fetch/product/" . $data['x'];
$response = file_get_contents($url);
$data = json_decode($response, true);
// show($data);


$reviews = isset($data['reviews']) ? $data['reviews'] : [];
// show($reviews);
$reviews_count = count($reviews);
// // $reviews_count = 2;
// show($reviews_count);


$urli = ROOT . "/fetch/product_images/" . $data['product_id'];
$response = file_get_contents($urli);
$images = json_decode($response, true);
// show($images);

if ($images) {
    $images_count = count($images);
} else {
    $images_count = 0;
}


?>

<style>
    .product-container {
        background-color: white;
        border-radius: 10px;
        padding: 10px;
    }

    .product-container-title {
        font-size: 1.1rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        text-align: center;
    }

    .product-container-item {
        display: flex;
        /* justify-content:first baseline; */
        /* justify-items: center; */
        margin-bottom: 0.5rem;
    }

    .product-container-d {
        /* display: flex;  */
        /* justify-content:first baseline;
        /* justify-items: center; */
        margin-bottom: 0.5rem;
    }

    .product-review-item {
        background-color: var(--light);
        border-radius: 10px;
        padding: 10px;
        margin-bottom: 0.5rem;
    }

    .pc-lable {
        font-weight: 500;
        margin-right: 0.5rem;
    }

    .dash-button {
        padding: 10px 20px;
        background-color: var(--blk);
        color: var(--light);
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        transition: background-color 0.2s ease-in-out;
        cursor: pointer;
    }

    .dash-button:hover {
        background-color: var(--primary);
        color: var(--light);
    }

    .dash-danger:hover {
        background-color: var(--danger);
        color: var(--light);
    }


    /* drag */
    .drag-area {
        background-color: var(--light);
        border-radius: 10px;
        /* height: 500px;
        width: 700px; */
        padding: 2rem 0;
        width: 100%;
        margin-bottom: 1rem;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .drag-area.active {
        border: 2px solid var(--blk);
    }

    .drag-area .icon {
        font-size: 100px;
        color: #fff;
    }

    .drag-area header {
        font-size: 20px;
        font-weight: 500;
        color: var(--blk);
    }

    .drag-area span {
        font-size: 20px;
        font-weight: 500;
        color: var(--blk);
        margin: 10px 0 15px 0;
    }

    .drag-area button {
        padding: 10px 25px;
        font-size: 20px;
        /* font-weight: 500; */
        border: none;
        outline: none;
        background: var(--blk);
        color: var(--light);
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.5s;
    }

    .drag-area button:hover {
        background: var(--primary);
        color: var(--light);
    }

    .drag-area img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        border-radius: 5px;
    }



    /* @media (max-width: 745px) {

        .drag-area button {
            padding: 8px 20px;
            font-size: 18px;
            font-weight: 450;
        }

        .drag-area {
            height: 400px;
            width: 450px;
        }

        .drag-area header {
            font-size: 25px;
            font-weight: 450;
            color: var(--blk);
        }

        .drag-area .icon {
            font-size: 80px;
        }

    } */
</style>



<!-- <?php if (message()) : ?>
    <div class="message-box">
        <div class="message"><?= message('', true) ?></div>
    </div>
<?php endif; ?> -->

<div class="table-section" style=" padding-bottom:0">
    <h2 class="table-section__title" style=" margin-bottom:0"><?= $data['name'] ?></h2>
</div>



<div class="dashboard2" id="pwc-table">
    <div class="product-container">

        <div style="text-align:right; padding-top:10px">
            <a href="<?php echo ROOT ?>/admin/products/update/<?= $data['product_id'] ?>" class="dash-button">Edit</a>
            <a onclick="openDeletePopup(<?= $data['product_id'] ?>)" class="dash-button dash-danger">Delete</a>
        </div>

        <h1 class="product-container-title">Product Details</h1>

        <div class="product-review-item">
            <div class="product-container-item">
                <p class="pc-lable">Product ID :&nbsp</p>
                <p><?php echo sprintf('PRD-%03d', $data['product_id']); ?></p>
            </div>
            <div class="product-container-d">
                <p class="pc-lable">Product Description :&nbsp</p>
                <p style="margin:5px 20px 10px 20px"><?php echo $data['description']; ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable"> Category :&nbsp</p>
                <p><?php echo $data['category_name'] ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">Quantity Available :&nbsp</p>
                <p><?php echo $data['quantity'] ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">Minimum Quantity for Bulk Orders :&nbsp</p>
                <p><?php echo $data['bulkmin'] ?></p>
            </div>
        </div>


        <h1 class="product-container-title" style="margin-top: 2rem;">Weight & measurements</h1>
        <div class="product-review-item">
            <div class="product-container-item">
                <p class="pc-lable">Height :&nbsp</p>
                <p><?php echo $data['height'] ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">Width :&nbsp</p>
                <p><?php echo $data['width'] ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">Length :&nbsp</p>
                <p><?php echo $data['length'] ?></p>
            </div>
            <div class="product-container-item">
                <p class="pc-lable">Weight :&nbsp</p>
                <p><?php echo $data['weight'] ?></p>
            </div>
        </div>
    </div>


    <!--  -->

    <div class="product-container">

        <?php if ($images_count < 4) : ?>
            <div style="text-align:right; padding-top:10px">
                <a href="#" class="dash-button" onclick="openPopup('add-item-popup')">Add Image</a>
            </div>
        <?php endif; ?>

        <h1 class="product-container-title">Product Images</h1>

        <?php if ($images_count == 0) : ?>
            <div class="mzg-box col-danger">
                <div class="messege"> <?= "No images added to this product" ?> </div>
            </div>
        <?php endif; ?>





        <?php if ($images_count > 0) : ?>
            <div class="product-review-item">
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
        <?php endif; ?>


    </div>

</div>

<div class="dashboard2" style="padding-top:0px" id="pwc-table">
    <div class="product-container">
        <h1 class="product-container-title" style=" text-align: left">Product Reviews</h1>

        <?php if ($reviews_count == 0) : ?>
            <div class="mzg-box col-danger">
                <div class="messege"> <?= "No reviews added to this product" ?> </div>
            </div>

        <?php endif; ?>

        <?php foreach ($reviews as $review) : ?>
            <div class="product-review-item">

                <div class="product-container-item">
                    <p class="pc-lable">Review ID :&nbsp</p>
                    <p><?php echo sprintf('RVW-%03d', $review['review_id']); ?></p>
                </div>
                <div class="product-container-item">
                    <p class="pc-lable">Customer Name :&nbsp</p>
                    <p><?php echo $review['customer_name'] ?></p>
                </div>
                <div class="product-container-item">
                    <p class="pc-lable">Rating :&nbsp</p>
                    <p><?php echo $review['rating'] ?></p>
                </div>
                <div class="product-container-item">
                    <p class="pc-lable">Review :&nbsp</p>
                    <p><?php echo $review['review'] ?></p>
                </div>
                <div class="product-container-item" style="font-size: smaller;">
                    <!-- <p>Created At :&nbsp</p> -->
                    <p><?php echo $review['created_at'] ?></p>
                </div>
                <!-- <div class="product-container-item">
                    <p>Updated At :&nbsp</p>
                    <p><?php echo $review['updated_at'] ?></p>
                </div> -->
            </div>
            <?php if ($reviews_count > 1) : ?>
                <hr style="margin: 0.3rem; width: 5%; margin-left: auto; margin-right: auto;">
            <?php endif; ?>
        <?php endforeach; ?>

    </div>

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

<!-- delete form -->
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


<!-- image upload popup -->
<div class="popup-form" id="add-item-popup">
    <div class="popup-form__content">
        <form action="<?php echo ROOT ?>/add/product_image" method="post" enctype="multipart/form-data" class="form">
            <h2 class="popup-form-title">Add Image - <?php echo sprintf('PRD-%03d', $data['product_id']); ?></h2>

            <div class="drag-area" ondrop="upload_file(event)" ondragover="return false" id="drop_zone">
                <div class="icon"><span class="material-symbols-outlined" style="font-size: 70px;">
                        cloud_upload
                    </span></div>
                <header class="header-upload">Drag & Drop or</header>
                <header class="header-upload">Click here to Upload Image</header>

                <!-- <button class="header-btn">Browse Images</button> -->

            </div>
            <input name="product_id" type="hidden" id="product_id" value="<?php echo $data['product_id'] ?>">
            <img id="preview" style="display: block; margin: 0 auto; margin-bottom:0.8rem; background-color:white; border-radius:10px;">
            <input name="image" type="file" id="file_input" style="display: none;" accept="image/*">

            <div class="form-group form-btns">
                <button type="submit" class="form-btn submit-btn">Add</button>
                <button type="button" class="form-btn cancel-btn" onclick="closePopup()">Cancel</button>
            </div>
        </form>

    </div>
</div>

<script>
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
        const images = Array.from(files);
        uploadFile(images[0]);
    }

    function uploadFile(file) {
        let reader = new FileReader();
        reader.onloadend = function() {
            preview.src = reader.result;
            preview.style.display = 'block';

            // Create a FormData instance
            let formData = new FormData();
            // Append the file
            formData.append('image', file);

            // Send the file data to the server
            fetch("<?php echo ROOT ?>/add/product_image", {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error(error);
                });
        }
        reader.readAsDataURL(file);
    }

    fileInput.addEventListener('change', function(e) {
        handleFiles(this.files);
    }, false);

    // Event listeners for file drop
    // dropZone.addEventListener('drop', function(e) {
    //     let dt = e.dataTransfer;
    //     let files = dt.files;

    //     handleFiles(files);
    // }, false);
    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();

        // Get the files from the drop event
        let files = e.dataTransfer.files;

        file = files[0];

        // Create a new FormData instance
        let formData = new FormData();

        // Append the product_id
        formData.append('product_id', document.getElementById('product_id').value);

        // Append the file
        formData.append('image', file);

        console.log(formData);

        // preview
        let reader = new FileReader();
        reader.onloadend = function() {
            preview.src = reader.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);

        // Send the file data to the server
        fetch("<?php echo ROOT ?>/add/product_image", {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error(error);
            });
    });

    // // Event listener for drop zone click to trigger file input click
    dropZone.addEventListener('click', function() {
        fileInput.click();
    }, false);
</script>

<script>
    // Function to open popup form
    function openPopup(popupId) {
        const popup = document.getElementById(popupId);
        popup.classList.add('popup-form--open');
    }

    // Function to close popup form
    function closePopup() {
        const popups = document.querySelectorAll('.popup-form');
        confirmText = document.querySelector('.confirmation-text');

        popups.forEach(popup => {
            popup.classList.remove('popup-form--open');
        });
    }
</script>








<?php include "inc/footer.view.php"; ?>