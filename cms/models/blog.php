<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';

class BlogModel extends Database
{
    public function BlogDataArray()
    {
        $this->prepare('SELECT * FROM `blog` ORDER BY `id` ASC');
        $this->statement->execute();
        return $this->fetchAll();
    }

    public function CreateBlogPost($title, $content, $image): bool
    {
        try
        {
            $this->connect()->beginTransaction();
            $this->prepare('INSERT INTO `blog` (`title`, `content`, `image`) VALUES (?, ?, ?)');
            $this->statement->execute([$title, $content, $image]);
            $this->commit();
        } catch (Throwable $error) {
            $this->rollBack();
            print_r("Error: " . $error->getMessage());
            return false;
        } finally {
            return true;
        }
    }
}