<?php $this->view('includes/header', $data) ?>
<?php $this->view('includes/nav', $data) ?>

<!-- <?php $cus = Auth::customerDetails();
    echo $cus->first_name;

    echo $data;
 ?> -->

<!-- home -->
<!-- Craft Component -->
<section class="craft">
    <div class="cards-grid">
        <h5 class="section-header">-Best Selling</h5>
        <h2 class="section-title">Our Best Seller</h2>
        <h2 class="section-title">Products</h2>
        <div class="craft-card">
            <div class="craft__image">
                <div class="craft__image__content">
                    <img src="<?php echo ROOT; ?>/assets/images/craft-1.png" alt="craft" />
                    <p class="craft__image__name">Nordic Chair</p>
                    <h4 class="craft__image__price">Rs15000.00</h4>
                </div>
                <button class="craft-btn">View</button>
        </div>
        <div class="craft__image">
            <div class="craft__image__content">
                <img src="<?php echo ROOT; ?>/assets/images/craft-1.png" alt="craft" />
                <p class="craft__image__name">Nordic Chair</p>
                <h4 class="craft__image__price">Rs15000.00</h4>
            </div>
            <button class="craft-btn">View</button>
    
        </div>
        <div class="craft__image">
            <div class="craft__image__content">
                <img src="<?php echo ROOT; ?>/assets/images/craft-1.png" alt="craft" />
                <p class="craft__image__name">Nordic Chair</p>
                <h4 class="craft__image__price">Rs15000.00</h4>
            </div>
            <button class="craft-btn">View</button>
    
        </div>
        <div class="craft__image">
            <div class="craft__image__content">
                <img src="<?php echo ROOT; ?>/assets/images/craft-1.png" alt="craft" />
                <p class="craft__image__name">Nordic Chair</p>
                <h4 class="craft__image__price">Rs15000.00</h4>
            </div>
            <button class="craft-btn">View</button>
    
        </div>
        <div class="craft__image">
            <div class="craft__image__content">
                <img src="<?php echo ROOT; ?>/assets/images/craft-2.png" alt="craft" />
                <p class="craft__image__name">Wingback Chair</p>
                <h4 class="craft__image__price">Rs.50000.00</h4>
            </div>
            <button class="craft-btn">View</button>
    
        </div>
        <div class="craft__image">
            <div class="craft__image__content">
                <img src="<?php echo ROOT; ?>/assets/images/craft-3.png" alt="craft" />
                <p class="craft__image__name">Accent Chair</p>
                <h4 class="craft__image__price">Rs.33000.00</h4>
            </div>
            <button class="craft-btn">View</button>
    
        </div>
            <!-- <div class="craft__image">
                <div class="craft__image__content">
                    <img src="<?php echo ROOT; ?>/assets/images/craft-4.png" alt="craft" />
                    <p class="craft__image__name">Modern Chair</p>
                    <h4 class="craft__image__price">$80.00</h4>
                </div>
                <button class="craft-btn">View</button>
        </div> -->
    </div>
</section>

<!-- Craft Component Styles -->
<style>

    /* General styles */
    .craft {
        display: flex;
        flex-direction: column;
        padding: 5rem 0;
        justify-content: centre;
        align-items: center;
    }
    
    .cards-grid {
        display: flex;
        flex-direction: column;
        width: 1200px;
        justify-content: centre;
    }

    .craft-card {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 3rem;
        margin-top: 4rem;
    }

    .craft__image {
        position: relative;
        isolation: isolate;
    }

    .craft__image__content {
        padding-bottom: 2rem;
        text-align: center;
        transition: 0.3s;
    }

    .craft__image__content img {
        margin-bottom: 1rem;
        max-width: 250px;
        margin: auto;
    }

    .craft__image__name {
        font-size: 1rem;
        font-weight: 500;
        color: var(--text-dark);
    }

    .craft__image__price {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    .craft__image:hover .craft-btn {
        opacity: 1;
    }

    .craft__image__content {
        padding-bottom: 2rem;
        text-align: center;
        transition: 0.3s;
        position: relative;
    }

    .craft-btn {
        opacity: 0;
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        background-color: var(--blk);
        color: #fff;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: opacity 0.3s ease-in;
        width: 100%;
        border-radius: 0 0 15px 15px;
    }

    .craft-btn:hover {
        background-color: var(--primary);
    }

    /* Styles for the hover effect */
    .craft__image::before {
        position: absolute;
        content: "";
        bottom: 0;
        left: 0;
        width: 100%;
        height: 50%;
        background-color: #ebf1f1;
        border-radius: 15px;
        transition: 0.3s;
        z-index: -1;
    }

    .craft__image:hover::before {
        height: 80%;
    }

    .craft__image:hover .craft__image__content {
        transform: translateY(-2rem);
    }

    /* Media queries */
    @media (max-width: 1200px) {
        .craft-card {
            gap: 1rem;
        }
    }

    @media (max-width: 900px) {
        .craft-card {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .craft__header {
            font-size: 2rem;
        }

        .craft__subheader {
            font-size: 1rem;
        }

        .craft__btn {
            font-size: 1rem;
        }

        .craft__image__name {
            font-size: 0.8rem;
        }

        .craft__image__price {
            font-size: 1rem;
        }
    }
</style>
<style>
    /* Styles for tablet */
    @media (max-width: 960px) {
        .craft-card {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* Styles for mobile */
    @media (max-width: 760px) {
        .craft-card {
            grid-template-columns: repeat(1, 1fr);
        }
    }
</style>

<?php $this->view('includes/footer', $data) ?>