<?php $this->view('includes/header', $data) ?>


<?php
if (Auth::logged_in()) {
  $this->view('includes/chat', $data);
}
?>
<div class="overlay" data-overlay></div>


<!--
    - HEADER
    -->

<header>
  <?php $this->view('includes/nav', $data) ?>
  <?php $this->view('webstore/header-section', $data) ?>

</header>

<!--
    - MAIN
  -->

<main>
  <?php $this->view('webstore/banner', $data) ?>
  <!--
      - PRODUCT
    -->

  <div class="product-container">

    <div class="container">
      <?php $this->view('webstore/sidebar', $data) ?>


      <div class="product-box">

        <?php $this->view('webstore/product-grid', $data) ?>
        <?php $this->view('webstore/product-featured', $data) ?>

      </div>

    </div>
    <!-- testimonals -->
    <section>
      <div class="container2">
      
        <div class="sub1">
        <div class="title">
          <div class="details"><p><i class="fas fa-minus"></i> Testimonals</p></div>
        </div>
        <div class="topic">
            <p>Our Customer</p>
            <p>Testimonials</p>
           </div>
           <div class="paragraph">
                
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                   et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
                   aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum 
                   dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia 
                   deserunt mollit anim id est laborum.</p>
                 <button type="submit" class="btn">Buy Now!</button>
                </div>
           </div>
        
         <section class="container3">
         <div class="sub2">
                <div class="testicontent">
                  <div class="slide">
                    <img src="img1/g1.jpg" alt="" class="image">
                    <div class="about">
                      <span class="name"> Shane Lee</span>
                      <span class="job"> Student, Digital Marketing</p>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                   et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
                   aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum 
                   dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia 
                   deserunt mollit anim id est laborum.</p>
                  </div>
                </div>
               
          
          </div>

      </div>
         </section>
         <style>
          .container2{
    margin: 3vw 0 ;
    padding: 1vw;
    background-color:#d6d6d6 ;
    display: flex;
    flex-direction: row ;


}
.sub1{
    display: flex;
    flex-direction: column;
    border-radius: 1rem;
    border: 2px solid #d6d6d6;
    margin:10px 10px 10px 20px;
    padding: 2vw;
    width: 48%;

}
.sub2{
    display: flex;
    flex-direction:row;
    border-radius: 1rem;
    border: 2px solid #d6d6d6;
    margin:10px 10px 10px 20px;
    padding: 2vw;
    width: 48%;
  
    justify-content: space-between;
}
/* .box {
   
    

    width: 30%;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: 1s;
    position: relative;
}

.box img {
    width: 100%;
    border-radius: 10px;
}

.box:hover {
    transform: scale(1.3);
    z-index: 2;
} 








 */
.sub2{
    position: relative;
    max-width: 900px;
    width: 100%;
    background-color:white; ;
    padding: 50px 0;
    row-gap:30px ;

    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: 1s;
}
.sub2:hover {
    transform: scale(.8);
    z-index: 1;
} 
 .sub2 .image{
    height: 170px;
    width: 170px;
    object-fit: cover;
    border-radius: 50%;
 }
 .container3{
    height: 100vh;
    width :100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #d6d6d6; 

 }
 .sub2 .slide{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
 }
 .slide p{
    padding: 0 100px;
    text-align: center;
    font-weight: 500;
    color: #333;
    
 }

 .slide .about{
    display:flex;
    flex-direction: column;
    align-items: center;
 }
 .about.name{
    font-size: 14px;
    font-weight: 600;
    color: black;
 }
 .about .job{
    font-size: 14px;
    font-weight: 600;
    color: #333; 
 }
 </style>
 


  </div>

  <div>
    <?php $this->view('webstore/product-benefits', $data) ?>
    <?php $this->view('webstore/product-category', $data) ?>
    <?php $this->view('webstore/product-newsletter', $data) ?>
  </div>



</main>


<?php $this->view('includes/footer', $data) ?>