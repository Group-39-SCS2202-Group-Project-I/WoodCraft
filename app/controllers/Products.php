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
			$this->view('product', $data);
		}
	}

	public function product($id){
        $productModel = new Product();
        $data['title'] = "product-reviews";

        $product_review = $productModel->getProductReview($id);
		$product_review_count = $productModel->getReviewCount($id);
		show($product_review);
		show($product_review_count);
    }

}



