<?php


 function testMessage($condtion, $message)
{
    if($condtion){
        echo "<div class='alert alert-success col-4 mx-auto mt-4'>
        $message  
        </div>
        ";
     }    
    
}
function dangerMessage($condtion, $message)
{
    if($condtion){
        echo "<div class='alert alert-danger col-4 mx-auto mt-5'>
        $message  
        </div>
        ";
     }    
    
}

function path($go){

    echo "<script>window.location.replace('/odc/$go')</script>";
}  


function auth($rule1 = null, $rule2 = null)
{
    if ($_SESSION['admin']) {
        if ($_SESSION['admin']['rule'] == 1 || $_SESSION['admin']['rule']  == $rule1  || $_SESSION['admin']['rule'] == $rule2) {
        } else {
            path("pages-error-404.php");
        }
    } else {
        path("admin/pages-login.php");
    }
}



function filterValidation($input_value)
{
    $input_value = trim($input_value);
    $input_value = strip_tags($input_value);
    $input_value = htmlspecialchars($input_value);
    $input_value = stripslashes($input_value);

    return $input_value;
}



function stringValidation($input_value, $size = 3)
{
    $empty = empty($input_value);
    $length = strlen($input_value) < $size;
    if ($empty == true || $length == true) {
        return true;
    } else {
        return false;
    }
}


function numberValidation($input_value)
{
    $empty = empty($input_value);
    $isNagtive = $input_value < 0;
    $isNumber = filter_var($input_value, FILTER_VALIDATE_FLOAT) == false;
    if ($empty == true || $isNagtive == true || $isNumber == true) {
        return true;
    } else {
        return false;
    }
}

function fileSizeValidation($imageName, $imageSize, $youSize = 2)
{
    $size =  ($imageSize / 1024) / 1024;

    $BigerSize =  $size > $youSize;
    $empty = empty($imageName);
    if ($BigerSize == true || $empty == true) {
        return true;
    } else {
        return false;
    }
}


function fileTypeValidation($file_type, $type1 = null, $type2 = null, $type3 = null, $type4 = null)
{
    if ($file_type == "$type1" || $file_type == "$type2 " || $file_type == "$type3" || $file_type == "$type4") {
        return false;
    } else {
        return true;
    }
}


?>




