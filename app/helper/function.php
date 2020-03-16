<?php

function showErrors($errors,$name){
    if ($errors->has($name)){
        echo '<div class="alert alert-danger" role="alert">';
        echo '<strong>'.$errors->first($name).'</strong>';
        echo '</div>';
    }
}

function GetCategory($mang, $parent, $tab, $id_selected){

    foreach($mang as $value){
        if($value['parent']==$parent){

            if($value['id'] == $id_selected){
                echo "<option value=".$value['id']." selected>".$tab.$value['name']."</option>";
            }else{
                echo "<option value=".$value['id']." > ".$tab.$value['name']."</option>";
            }

            GetCategory($mang, $value['id'],$tab."--|", $id_selected );
        }
    }
}

function ShowCategory($mang, $parent, $tab){
    // foreach($mang as $value){
    //     echo $value['parent'];
    // }
    // echo $parent;
    foreach($mang as $value){
        if($value['parent']==$parent){
           
            echo '<div class="item-menu"><span>'.$tab.$value['name'].'</span>
                    <div class="category-fix">
                        <a class="btn-category btn-primary" href="/admin/category/edit/'.$value['id'].'"><i class="fa fa-edit"></i></a>
                        <a onclick="return Del()" class="btn-category btn-danger" href="/admin/category/del/'.$value['id'].'"><i class="fas fa-times"></i></i></a>
                    </div>
                </div>';
                
                ShowCategory($mang, $value['id'],$tab."--|" );
            }

        } 
}

function GetLevel($mang, $parent, $count)
{
    foreach($mang as $value)
    {
        if($value['id']==$parent)
        {
                $count++;
            if($value['parent']==0)
            {
                return $count;
            }
            return GetLevel($mang, $value['parent'], $count); 
        }

          
     }
}



