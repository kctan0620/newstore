<?php
class ControllerToolMigrate extends Controller {
    public function index() {
		
	$this->load->model('catalog/product');
			
        $filter_data = array(
                'start'              => 0,
				'limit'              => 30000
        );					
		$results = $this->model_catalog_product->getProductsImage($filter_data);	

        //$results = $this->model_catalog_product->getProductsImageId($filter_data);
		
		$resultidimage = '';
	
		foreach ($results as $result) {
				
			$resultidimage = $result['id_image'];
				//split id_image
				$arr1 = str_split($resultidimage);
				$arr2 = str_split($resultidimage,2);
				print_r($arr1);
				print_r($arr2);
				
				$link = '';
				echo $resultidimage;
				foreach($arr1 as $id){
					$com = array($id);  
				 // $com = $arr1
								
					$link .= $com[0] .'/';  
				 }
				$link .= $resultidimage; 
				echo var_dump ($link);
				echo $link; 
			
				$newLink = 'http://www.tmt.my/onlinestore/img/p/'.$link.'-large_default.jpg';
				//$newLink = 'http://localhost/onlinestore/img/p/'.$link.'-large_default.jpg';
				//echo $newLink;

				//Get the file
				$content = file_get_contents($newLink);
				//Store in the filesystem.
				$fp = fopen("../image/catalog/20150824/".$resultidimage."-large_default.jpg", "w");
				fwrite($fp, $content);
				fclose($fp);
		}
    }
	
	public function populateCategory()
	{
		$this->load->model('catalog/category');
		$this->model_catalog_category->populateCategoryPath();
		echo 'MIGRATE HAS DONE';
	}
} 



 

