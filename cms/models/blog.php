<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';

class BlogData extends Database
{
    public function BlogDataArray()
    {
        $this->prepare('SELECT * FROM `blog` ORDER BY `id` ASC');
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function CreateBlogPost($title, $content, $image): bool
    {
        $this->prepare('INSERT INTO `blog` (`title`, `content`, `image`) VALUES (?, ?, ?)');
     
        if ($this->statement->execute([$title, $content, $image]))
        {
            return true;
        } else {
            return false;
        }
    }
}