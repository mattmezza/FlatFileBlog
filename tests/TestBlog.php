<?php

require_once "vendor/autoload.php";

use PHPUnit\Framework\TestCase;
use FlatFileBlog\BlogManager;
use Symfony\Component\Yaml\Yaml;

class TestBlog extends TestCase {

  private $blog_manager;
  private $url;
  private $posts_dir;
  private $posts_perpage;
  private $pages_dir;
  private $authors;

  public function __construct() {
    parent::__construct();
    $this->url = "dummy.it/";
    $this->posts_dir = __DIR__ . "/posts";
    $this->posts_perpage = 5;
    $this->pages_dir = __DIR__ . "/pages";
    $this->authors = array(
      "admin"=>array(
        "name"=>"Administrator"
      ),
      "editor"=>array(
        "name"=>"Mr. Editor"
      )
    );
    $this->blog_manager = new BlogManager($this->url, $this->posts_dir, $this->posts_perpage, $this->pages_dir, $this->authors);
  }

  public function test_get_page() {
    $page = $this->blog_manager->get_page("test");
    $this->assertEquals($page->body, "<p>Test</p>");
  }

  public function test_get_post_names() {
    $posts_names = $this->blog_manager->get_post_names();
    $this->assertEquals(count($posts_names), 1);
  }

  /**
   * @depends test_get_post_names
   */
  public function test_find_post() {
    $post = $this->blog_manager->find_post(2016, 11, "test");
    $this->assertEquals($post->body, "<p>Test</p>");
  }

  /**
   * @depends test_get_post_names
   */
  public function test_get_posts() {
    $posts = $this->blog_manager->get_posts();
    $this->assertEquals($posts[0]->body, "<p>Test</p>");
  }

  /**
   * @depends test_get_posts
   */
  public function test_json_api() {
    $postsjson = json_decode($this->blog_manager->get_posts_json());
    $this->assertEquals($postsjson[0]->body, "<p>Test</p>");
  }

  /**
   * @depends test_get_post_names
   */
  public function test_pagination() {
    $pagination = $this->blog_manager->has_pagination();
    $this->assertFalse($pagination["prev"]);
    $this->assertFalse($pagination["next"]);
  }

  /**
   * @depends test_get_post_names
   */
  public function test_get_post_links() {
    $posts_links = $this->blog_manager->get_post_links();
    $this->assertEquals($posts_links[0]->url, $this->url."2016/11/test");
  }

}

 ?>
