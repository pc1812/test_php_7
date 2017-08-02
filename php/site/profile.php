<?php

require_once __DIR__.'/../main/init.php';

use App\View\ProfileView;

if ($auth->isGuest()) {
    header('Location: login.php');
    die();
}

$profiles = $auth->getProfiles();

function updateProfile($formAttrName, $profileName, $func='')
{
    if (isset($_POST[$formAttrName])) {
        $attribute = strip_tags($_POST[$formAttrName]);
        if (strlen($attribute) > 0) {
            global $profiles;
            global $model;
            $aff = $model->updateData(
                "update users set ".$profileName."=".$func."(:attribute) where id=:id",
                ['id'=>$profiles['id'], 'attribute'=>$attribute]
            );
            error_log('affected rows '.$aff, 0);
            if ($aff == 1) {
                $profiles[$profileName] = $attribute;
            }
        }
        
    }
}

updateProfile('nickname', 'name');
updateProfile('password', 'password', 'password');

$uploads_dir = 'pictures';
foreach ($_FILES["pictures"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
        // basename() may prevent filesystem traversal attacks;
        // further validation/sanitation of the filename may be appropriate
        $name = basename($_FILES["pictures"]["name"][$key]);
        $newname = $profiles['id'].substr($name, strrpos($name, '.', -1), strlen($name));
        error_log('new file '.$newname, 0);
        $picture_url = $uploads_dir."/".$newname;
        move_uploaded_file($tmp_name, __DIR__."/".$picture_url);
        $aff = $model->updateData(
            "update users set picture_url=:picture_url where id=:id",
            ['id'=>$profiles['id'], 'picture_url'=>$picture_url]
            );
        if ($aff == 1) {
            $profiles['picture_url'] = $picture_url;
        }
    }
}

$view = new ProfileView();
$view->display($profiles);
