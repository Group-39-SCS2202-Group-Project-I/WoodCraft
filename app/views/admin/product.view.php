<?php include "inc/header.view.php"; ?>

<!-- fetch and display data -->
<?php
$url = ROOT . "/fetch/product/" . $data['x'];
$response = file_get_contents($url);
$data = json_decode($response, true);
// show($data['product_id']);
?>



<?php if (message()) : ?>
    <div class="mzg-box">
        <div class="messege"><?= message('', true) ?></div>
    </div>
<?php endif; ?>



<style>
    /* table */
    .list-section {
        margin: 0 auto;
        /* max-width: 800px; */
        padding: 0 20px;
        background-color: var(--light);
        border-radius: 10px;
        /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); */
        display: flex;
    }

    .list-section__title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 15px;
        /* text-align: center; */
        color: var(--blk);
    }

    /* .product-container {
        display: flex;
    } */

    .flex-half {
        flex: 1;
        padding: 0 20px;
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

    .detail-item {
        display: flex;
        align-items: center;
        margin-bottom: 5px;

    }

    .detail-item label {
        font-size: 1.2rem;

    }

    .detail-item span {
        font-size: 1.2rem;
        font-weight: 500;
    }

    #image-form {
        /* display: flex; */
        /* flex-direction: column; */
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .center-items {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    /*  */
    #drop_zone {
        margin-top: 2rem;
        margin-bottom: 1rem;
        border: 1px solid black;
        text-align: center;
        padding: 40px;
    }


    #preview {
        display: none;
        max-width: 300px;
        max-height: 300px;
        /* padding: 1rem; */
        object-fit: cover;
        text-align: center;

    }
</style>

<html>

<body>

    <div class="list-section">
        <div class="flex-half">
            <section>

                <div class="table-section">
                    <div style=" text-align: right;">
                        <a href="<?php echo ROOT ?>/admin/products/update/<?= $data['product_id'] ?>" class="table-section__add-link">Update Product Details</a>
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
                        <label>Description : </label>
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
                        <img id="preview" style="display: block; margin: 0 auto; margin-bottom:0.8rem;">
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

                // Add event listeners for file selection and drop here
                // Event listener for file selection
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
    </div>


</body>

</html>




<?php include "inc/footer.view.php"; ?>