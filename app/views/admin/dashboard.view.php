<?php include "inc/header.view.php"; ?>

<div class="table-section">
    <h2 class="table-section__title">Table Section</h2>

    <div class="table-section__add" onclick="openPopup('add-item-popup')">
        <a href="#" class="table-section__add-link">Add New Item</a>
    </div>

    <div class="table-section__search">
        <input type="text" id="search" placeholder="Search..." class="table-section__search-input">
    </div>


    <table class="table-section__table">
        <thead>
            <tr>
                <th data-column="id">ID</th>
                <th data-column="name">Name</th>
                <th data-column="images">Images</th>
                <th data-column="category">Category</th>
                <th data-column="price">Price</th>
                <th data-column="details">Details</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="table-section__tbody">
            <tr>
                <td>1</td>
                <td>Item 1</td>
                <td><img src="item1.jpg" alt="Item 1"></td>
                <td>Category 1</td>
                <td>$10.00</td>
                <td>Material: Wood<br>Weight: 1kg<br>Dimensions: 10x10x10cm</td>
                <td>
                    <a href="#" class="table-section__button">View</a>
                    <a href="#" class="table-section__button">Update</a>
                    <a href="#" class="table-section__button table-section__button-del ">Delete</a>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>Item 1</td>
                <td><img src="item1.jpg" alt="Item 1"></td>
                <td>Category 1</td>
                <td>$10.00</td>
                <td>Material: Wood<br>Weight: 1kg<br>Dimensions: 10x10x10cm</td>
                <td>
                    <a href="#" class="table-section__button">View</a>
                    <a href="#" class="table-section__button">Update</a>
                    <a href="#" class="table-section__button table-section__button-del">Delete</a>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>Item 1</td>
                <td><img src="item1.jpg" alt="Item 1"></td>
                <td>Category 1</td>
                <td>$10.00</td>
                <td>Material: Wood<br>Weight: 1kg<br>Dimensions: 10x10x10cm</td>
                <td>
                    <a href="#" class="table-section__button">View</a>
                    <a href="#" class="table-section__button">Update</a>
                    <a href="#" class="table-section__button table-section__button-del">Delete</a>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>Item 1</td>
                <td><img src="item1.jpg" alt="Item 1"></td>
                <td>Category 1</td>
                <td>$10.00</td>
                <td>Material: Wood<br>Weight: 1kg<br>Dimensions: 10x10x10cm</td>
                <td>
                    <a href="#" class="table-section__button">View</a>
                    <a href="#" class="table-section__button">Update</a>
                    <a href="#" class="table-section__button table-section__button-del">Delete</a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Item 2</td>
                <td><img src="item2.jpg" alt="Item 2"></td>
                <td>Category 2</td>
                <td>$20.00</td>
                <td>Material: Metal<br>Weight: 2kg<br>Dimensions: 20x20x20cm</td>
                <td>
                    <a href="#" class="table-section__button">View</a>
                    <a href="#" class="table-section__button">Update</a>
                    <a href="#" class="table-section__button table-section__button-del">Delete</a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Item 3</td>
                <td><img src="item3.jpg" alt="Item 3"></td>
                <td>Category 3</td>
                <td>$30.00</td>
                <td>Material: Plastic<br>Weight: 3kg<br>Dimensions: 30x30x30cm</td>
                <td>
                    <a href="#" class="table-section__button">View</a>
                    <a href="#" class="table-section__button">Update</a>
                    <a href="#" class="table-section__button table-section__button-del">Delete</a>
                </td>
            </tr>
        </tbody>
    </table>


    <!-- Add new item popup form -->
    <div class="popup-form" id="add-item-popup">
        <div class="popup-form__content">
            <form action="#" method="POST" class="form">
                <h2 class="popup-form-title">Add New Item</h2>
                <div class="form-group">
                    <label for="item-name" class="form-label label-popup">Item Name</label>
                    <input type="text" id="item-name" name="item-name" class="form-input input-popup" required>
                </div>
                <div class="form-group">
                    <label for="item-image" class="form-label label-popup">Item Image</label>
                    <input type="file" id="item-image" name="item-image" class="form-input input-popup" required>
                </div>
                <div class="form-group">
                    <label for="item-category" class="form-label label-popup">Item Category</label>
                    <select id="item-category" name="item-category" class="form-select input-popup" required>
                        <option value="">Select a category</option>
                        <option value="category1">Category 1</option>
                        <option value="category2">Category 2</option>
                        <option value="category3">Category 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="item-price" class="form-label label-popup">Item Price</label>
                    <input type="number" id="item-price" name="item-price" class="form-input input-popup" required>
                </div>
                <div class="form-group">
                    <label for="item-details" class="form-label label-popup">Item Details</label>
                    <textarea id="item-details" name="item-details" class="form-textarea input-popup" required></textarea>
                </div>
                <div class="form-group form-btns">
                    <button type="submit" class="form-btn submit-btn">Add Item</button>
                    <button type="button" class="form-btn cancel-btn" onclick="closePopup()">Cancel</button>
                </div>
            </form>

        </div>
    </div>

    <!-- Update item popup form -->


    <!-- Delete item popup form -->
    <!-- Delete item popup form -->
    <div class="popup-form" id="delete-item-popup">
        <div class="popup-form__content">
            <form action="#" method="POST" class="form">
                <!-- <h2 class="popup-form-title">Delete Item</h2> -->
                <p>Are you sure you want to delete this item?</p>

                <div class="form-group frm-btns">
                    <button type="submit" class="form-btn submit-btn">Yes</button>
                    <button type="button" class="form-btn cancel-btn" onclick="closePopup()">No</button>
                </div>
            </form>
        </div>
    </div>

    <button onclick="openPopup('delete-item-popup')">Delete Item</button>

    <?php include "inc/footer.view.php"; ?>