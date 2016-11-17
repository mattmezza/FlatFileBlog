<?php

require_once '../vendor/autoload.php'; // Autoload files using Composer autoload

use FlatFileBlog\BlogManager;
use Symfony\Component\Yaml\Yaml;

error_reporting(E_ALL);

$posts_dir = __DIR__ . "/posts";
$posts_perpage = 5;
$url = "dummy.it/";
$pages_dir = __DIR__ . "/pages";
$authors = array(
  "admin"=>array(
    "name"=>"Administrator"
  ),
  "editor"=>array(
    "name"=>"Mr. Editor"
  )
);

$blog_manager = new BlogManager($url, $posts_dir, $posts_perpage, $pages_dir, $authors);

$page = $blog_manager->get_page("test");
if ($page->body == "<p>Test</p>") {
  echo "Page test:\t\tSUCCESS\n";
} else {
  echo "Page test:\t\tNOT PASSED\n";
}

$post = $blog_manager->find_post(2016, 11, "test");
if ($post->body == "<p>Test</p>") {
  echo "Post test:\t\tSUCCESS\n";
} else {
  echo "Post test:\t\tNOT PASSED\n";
}

$posts = $blog_manager->get_posts();
if ($posts[0]->body == "<p>Test</p>") {
  echo "Posts test:\t\tSUCCESS\n";
} else {
  echo "Posts test:\t\tNOT PASSED\n";
}

$postsjson = json_decode($blog_manager->get_posts_json());
if ($postsjson[0]->body == "<p>Test</p>") {
  echo "Posts2json test:\tSUCCESS\n";
} else {
  echo "Posts2json test:\tNOT PASSED\n";
}

$pagination = $blog_manager->has_pagination();
if ($pagination["prev"]!=false || $pagination["next"] != false) {
  echo "Pagination test:\tNOT PASSED\n";
} else {
  echo "Pagination test:\tSUCCESS\n";
}

$posts_names = $blog_manager->get_post_names();
if(count($posts_names)!=1) {
  echo "Posts names test:\tNOT PASSED\n";
} else {
  echo "Posts names test:\tSUCCESS\n";
}

$posts_links = $blog_manager->get_post_links();
if ($posts_links[0]->url == "dummy.it/2016/11/test") {
  echo "Posts links test:\tSUCCESS\n";
} else {
  echo "Posts links test:\tNOT PASSED\n";
}
