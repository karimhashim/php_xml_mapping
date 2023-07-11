<?php

class FileModel {
    private  $id;
    private  $randomId;
    private  $name;
    private  $parentId;
    private  $groupId;
    private  $driveId;
    private  $type;
    private  $isActive = true;
    private  $isDeleted = false;

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setRandomId(string $randomId): void
    {
        $this->randomId = $randomId;
    }

    public function getRandomId(): string
    {
        return $this->randomId;
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

    public function setDriveId(string $driveId): void
    {
        $this->driveId = $driveId;
    }

    public function getDriveId(): string
    {
        return $this->driveId;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
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