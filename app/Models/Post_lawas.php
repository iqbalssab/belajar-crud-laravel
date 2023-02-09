<?php

namespace App\Models;



class Post 
{
    private static $blog_posts = [
        [
            "title" => "Judul post pertama",
            "slug" => "judul-post-pertama",
            "author" => "Benkskuy",
            "body" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum harum repellat cum quod, odit doloribus nemo excepturi, obcaecati dolores numquam maxime quibusdam expedita vel? Asperiores iste similique suscipit praesentium ipsam amet at ipsa minima, facilis, molestias ad exercitationem, vel voluptatibus sint ex veniam quae quasi! Temporibus, expedita nesciunt nihil dolores eos totam facilis rerum. Dolore illo sapiente id dolores obcaecati dolor, recusandae est reiciendis alias. Quo, veniam eaque! Reprehenderit velit fugit esse? Blanditiis explicabo ab illum quos voluptatem tenetur nam?"
        ],
        [
            "title" => "Judul post keuda",
            "slug" => "judul-post-kedua",
            "author" => "Benkskuy",
            "body" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nemo consequuntur, non mollitia, dolores ea vel repellendus id officia necessitatibus, molestiae commodi aliquam quod! Earum asperiores cumque aspernatur libero adipisci a vel et quod optio, facere, nisi iure accusamus mollitia tempore fugiat explicabo voluptatibus, totam dignissimos molestiae porro incidunt eaque suscipit reiciendis. Qui debitis dolor similique dolorem laudantium non perferendis ipsa iure dignissimos quisquam quis tempore rem ea neque, voluptates repudiandae eaque! Esse suscipit, fuga deleniti pariatur ab error assumenda accusamus eius qui accusantium ipsam in doloribus, consequuntur eaque sequi laborum? Ipsum voluptate repellendus error soluta qui dolore quis quas? Omnis."
        ]
    ];

    public static function all()
    {
        return collect(self::$blog_posts);
    }

    public static function find($slug)
    {
        $posts = static::all();
        
        return $posts->firstWhere('slug', $slug);
    }

}
