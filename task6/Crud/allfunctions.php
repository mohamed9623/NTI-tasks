<?php
function clean_data($data)
{
    $data = trim($data);
    $data = strtolower(strip_tags($data));
    return $data;
}

function upload_image($imgName, $imgTempPath, $imgSize, $imgType, $errors)
{
    $imgExtension = explode('.', $imgName);
    $imgExtension = end($imgExtension);
    $allowedExtensions = ['png', 'jpg', 'gif'];

    if (in_array($imgExtension, $allowedExtensions)) {

        $finalImgName = rand() . time() . '.' . $imgExtension;
        $dis_path = './uploads/' . $finalImgName;
        $_SESSION['finalImgName']=$finalImgName;
        if (!move_uploaded_file($imgTempPath, $dis_path)) {
            $errors['uploadError'] = 'failed to upload';
        }
    } else {
        $errors['noImage'] = 'Extension not allowed!';
    }
}

function image_validate($imgName, $imgTempPath, $imgSize, $imgType, $errors)
{

    if (!empty($_FILES['image']['name'])) {
        upload_image($imgName, $imgTempPath, $imgSize, $imgType, $errors);
    } else {
        $errors['isImage'] = 'please enter a valid image';
    }
    return $errors;
}

function data_validate($title, $content, $date, $errors)
{
    //name validation
    if (empty($title)) {
        $errors['titleEmpty'] = 'please enter your name';
    } elseif (!is_string($title)) {
        $errors['titleType'] = 'please enter a valid title (string)';
    }

    //content validation
    if (empty($content)) {
        $errors['contentEmpty'] = 'please enter your content';
    } elseif (strlen($content) < 50) {
        $errors['contentLength'] = 'content must be more than 50 characters';
    }
    //$date validation
    if (empty($date)) {
        $errors['dateEmpty'] = 'please enter your date';
    }
    return $errors;
}
