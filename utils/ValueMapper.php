<?php

require_once "models/FolderModel.php";
require_once "models/FileModel.php";
class ValueMapper
{
    public static function convertToFolderModel(SimpleXMLElement $xmlElement, string $parentId) : FolderModel {
        $folderModel = new FolderModel();
        $folderModel->setId((string)$xmlElement->attributes()->identifier);
        $folderModel->setName((string)$xmlElement->title);
        $folderModel->setParentId($parentId);

        return $folderModel;
    }

    public static function ConvertToFileModel(SimpleXMLElement $xmlElement, string $parentId) : FileModel {
        $fileModel = new FileModel();
        $fileModel->setId((string)$xmlElement->attributes()->identifier);
        $fileModel->setName((string)$xmlElement->title);
        $fileModel->setType(substr( strrchr((string)$xmlElement->title, '.'), 1));
        $fileModel->setRandomId(uniqid());
        $fileModel->setParentId($parentId);

        return $fileModel;

    }

}