<?php

use App\Comment;
use App\Notifications\PostCommented;
use App\User;
use Illuminate\Notifications\Messages\MailMessage;

class PostCommentedTest extends TestCase
{
    /**
     * @test
     */
    function it_builds_a_email_message()
    {
        $post = factory(\App\Post::class)->create([
            'title' => 'Titulo del post'
        ]);

        $author = new User([
            'name' => 'Yasser Mussa'
        ]);

        $comment = new Comment();
        $comment->post = $post;
        $comment->user = $author;

        $notification = new PostCommented($comment);

        $subscriber = new User();

        $message = $notification->toMail($subscriber);

        $this->assertInstanceOf(MailMessage::class, $message);

        $this->assertSame(
            'Nuevo comentario en: Titulo del post',
            $message->subject
        );

        $this->assertSame(
            'Yasser Mussa escribió un comentario en: Titulo del post',
            $message->introLines[0]
        );

        $this->assertSame($comment->post->url, $message->actionUrl);
    }
}
