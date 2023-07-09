<?php

require_once "models/FolderModel.php";
require_once "models/FileModel.php";
class ValueMapper
{
    public static function convertToFolderModel($xmlData) : FolderModel {
        $folderModel = new FolderModel();


        return $folderModel;
    }

    public static function CreateParentFoldersOfOrganization($organizationFolder) : FolderModel {
        $folderModel = new FolderModel();
        $folderModel->setId($organizationFolder->identifier);
        return $folderModel;
    }

    public static function ConvertToFileModel($xmlData) : FileModel{

        $fileModel = new FileModel();

        return $fileModel;

    }

}