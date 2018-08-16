<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function displayCategoriesOptions($categories,$parent_id=0)
{
    $new_cats = array();
    foreach($categories as $category){

        if($category->parent_id == $parent_id ){
            array_push($new_cats,$category);
            $newparent_id = $category->id;
            foreach($categories as $category){

                if($category->parent_id == $newparent_id ){
                    array_push($new_cats,$category);

                    foreach($categories as $category){
                        $new2parent_id = $category->id;
                        if($category->parent_id == $new2parent_id ){
                            array_push($new_cats,$category);
                            
                        }
                
                    }
                    
                }
        
            }
        }

    }
    var_dump($new_cats);
    echo "<br>---------------------------------------------<br>";
    print_r($categories);
}   

