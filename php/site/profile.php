<?php

require_once __DIR__.'/../main/init.php';

use App\View\ProfileView;
use App\Uploader;

if ($auth->isGuest()) {
    header('Location: login.php');
    die();
}

$profiles = $auth->getProfiles();

function updateProfile($profileName, $profileValue, $func='')
{
    global $profiles;
    global $model;
    $aff = $model->updateData(
        "update users set ".$profileName."=".$func."(:attribute) where id=:id",
        ['id'=>$profiles['id'], 'attribute'=>$profileValue]
    );
    error_log('affected rows '.$aff, 0);
    if ($aff == 1) {
        $profiles[$profileName] = $profileValue;
    }
}

function pictureUploaded($tmp_name, $toName)
{
    updateProfile('picture_url', "pictures/".$toName);
}


if ($request->hasPost('nickname')) {
    updateProfile('name', $request->post['nickname']);
}

if ($request->hasPost('password')) {
    updateProfile('password', $request->post['password'], 'password');
}

if (isset($_FILES['pictures'])) {
    $uploader = new Uploader(__DIR__."/pictures",  ['.gif', '.png', '.jpg', '.jpeg']);
    $uploader->upload('pictures', 'pictureUploaded', $profiles['id']);
}

$view = new ProfileView();
$view->display($profiles);
