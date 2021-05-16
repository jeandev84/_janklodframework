<?php
namespace App\Controller;


use Jan\Component\Templating\Renderer;

/**
 * Class PostController
 * @package App\Controller
*/
class PostController
{
    protected $view;

    public function __construct()
    {
        $this->view = new Renderer(__DIR__.'/../../views');
    }

    public function index()
    {
        $posts = [
           [
               'id' => 1,
               'title' => 'Post 1',
               'content' => 'first post of articles ...',
               'publishedAt' => '2021-05-16', // date('Y-m-d H:i:s')
           ],
           [
                'id' => 2,
                'title' => 'Post 2',
                'content' => 'second post of articles ...',
                'publishedAt' => '2021-05-15', // date('Y-m-d H:i:s')
           ],
           [
                'id' => 3,
                'title' => 'Post 3',
                'content' => 'third post of articles ...',
                'publishedAt' => '2021-05-11', // date('Y-m-d H:i:s')
           ],
        ];

        return $this->view->render('post/index.php', compact('posts'));
    }


    public function show($id)
    {
        $post = static::getPost($id);

        if(! $post) {
            throw new \Exception('Post with id : '. $id . ' doest not exist!');
        }

        return $this->view->render('post/show.php', compact('post'));
    }


    /**
     * @return array[]
    */
    protected static function getPosts()
    {
        return [
            [
                'id' => 1,
                'title' => 'Post 1',
                'content' => 'first post of articles ...',
                'publishedAt' => '2021-05-16', // date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'title' => 'Post 2',
                'content' => 'second post of articles ...',
                'publishedAt' => '2021-05-15', // date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'title' => 'Post 3',
                'content' => 'third post of articles ...',
                'publishedAt' => '2021-05-11', // date('Y-m-d H:i:s')
            ],
        ];
    }


    /**
     * @param $id
     * @return array
   */
    public static function getPost($id)
    {
        foreach (static::getPosts() as $post)
        {
            if($post['id'] == $id)
            {
                return $post;
            }
        }

        return [];
    }
}