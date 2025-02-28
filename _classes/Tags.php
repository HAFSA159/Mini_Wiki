`<?php

class Tags
{
    public $tag_id;
    public $tag;
    public $id;
    public $name;

    public function __construct($id)
    {
      
    }

    static function create($tag){
        global $db;
        $stmt = $db->prepare('INSERT INTO tags (name) VALUES (:tagName)');
        $stmt->bindValue(':tagName', $tag, PDO::PARAM_STR);
        $stmt->execute();
    }

    static function getAllTags() : array
    {
        global $db;
        
        $result = $db->query("select * from tags ORDER BY id DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    static function getTagById($tagId): ?array
    {
    global $db;
    $query = "SELECT * FROM tags WHERE id = :id";
    $stm = $db->prepare($query);
    $stm->bindValue(':id', $tagId, PDO::PARAM_INT);
    $exe = $stm->execute();

    if ($exe) {
        $result = $stm->fetch(PDO::FETCH_ASSOC);

        return $result !== false ? $result : null;
    } else {
        return null;
    }
    }

    static function deleteTag($id) : bool
    {
        global $db;
        $query = "delete from tags WHERE id = :id";
        $stm = $db->prepare($query);
        $stm->bindValue(':id', $id, PDO::PARAM_INT);

        return $stm->execute();
    }

    static function updateTag($id, $newName) : bool
    {
        global $db;
        $query = "UPDATE tags SET name = :newName WHERE id = :id";
        $stm = $db->prepare($query);
        $stm->bindValue(':id', $id, PDO::PARAM_INT);
        $stm->bindValue(':newName', $newName, PDO::PARAM_STR);

        return $stm->execute();
    }
    
    // function UpdateTag(): bool
    // {
    //     global $db;
    //     $query = "UPDATE tags SET name = :name WHERE id = :id";
    //     $stm = $db->prepare($query);
    //     $stm->bindValue(':name', $this->name, PDO::PARAM_STR);
    //     $stm->bindValue(':id', $this->id, PDO::PARAM_INT);

    //     return $stm->execute();
    // }
}