<?php

class FolderModel
{
    private string $id;
    private string $name;
    private string $parentId = "";
    private string $groupId = "";
    private array $childrenFolders;
    private array $childrenFiles;
    private bool $isActive = true;
    private bool $isDeleted = false;

    public function __construct()
    {
        $this->childrenFolders = array();
        $this->childrenFiles = array();
    }


    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setParentId(string $parentId): void
    {
        $this->parentId = $parentId;
    }

    public function getParentId(): string
    {
        return $this->parentId;
    }

    public function setGroupId(string $groupId): void
    {
        $this->groupId = $groupId;
    }

    public function getGroupId(): string
    {
        return $this->groupId;
    }

    public function addToChildrenFolders(FolderModel $childFolder): void
    {
        $this->childrenFolders[] = $childFolder;
    }

    public function getChildrenFolders(): array
    {
        return $this->childrenFolders;
    }

    public function addToChildrenFiles(FileModel $childFile): void
    {
        $this->childrenFiles[] = $childFile;
    }

    public function getChildrenFiles(): array
    {
        return $this->childrenFiles;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsDeleted(bool $isDeleted): void
    {
        $this->isDeleted = $isDeleted;
    }

    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }


}