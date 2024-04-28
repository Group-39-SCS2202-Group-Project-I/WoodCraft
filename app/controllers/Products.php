<?php 

/**
 * products class
 */
class Products extends Controller
{
	public function index($id = '')
	{
		$data['id'] = $id;
		if($id == ''){
			$this->view('products', $data);
		}
		else{

			$productModel = new Product();
			$data['title'] = "Product Details";

			// Fetch reviews and review count for the specified product
			$product_review = $productModel->getProductReview($id);
			$product_review_count = $productModel->getReviewCount($id);
			$data['product_review'] = $product_review;
			$data['product_review_count'] = $product_review_count;

				// show($product_review);
				// show($product_review_count);

			$this->view('product', $data);
		}
	}

	// public function product($id){
    //     $productModel = new Product();
    //     $data['title'] = "product-reviews";

    //     $product_review = $productModel->getProductReview($id);
	// 	$product_review_count = $productModel->getReviewCount($id);
	// 	show($product_review);
	// 	show($product_review_count);
    // }
}