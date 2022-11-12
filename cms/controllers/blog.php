<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../models/blogdata.php';

class Blog
{
    public function GetBlogArray()
    {
        $Blog = new BlogModel();
        return $Blog->BlogDataArray();
    }

    public function CreateBlogPost($data): string
    {
        $Blog = new BlogModel();

        $title = trim($data['title']);
        $content = trim($data['content']);
        $image = trim($data['image']);

        $response = $Blog->CreateBlogPost($title, $content, $image);

        return ($response) ? 'Blog post created.' : 'Blog post creation failed.';
    }
}