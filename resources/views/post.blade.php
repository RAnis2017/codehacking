@extends('layouts.blog-post')
@section('content')

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{ $post->title }}</h1>
    <hr>
    <p><i class="fa  fa-user  fa-fw"></i>Autor: <strong>{{ $post->user->name }}</strong>  | <span class="fa  fa-calendar  fa-fw"></span> Fecha de Creación: <strong>{{ $post->created_at->format('d-m-Y') }}</strong></p>
    <hr>
    <!-- Preview Image -->
    <img class="img-responsive" src="{{ $post->photo->file }}" alt="">
    <hr>
    <!-- Post Content -->
    <p>{{ $post->body }}</p>
    <hr>

    @if(Session::has('comment_message'))
        {{ session('comment_message') }}
    @endif
    <!-- Blog Comments -->

    @if(Auth::check())

        <!-- Comments Form -->
        <div class="well">
            <h4>Escribe un comentario:</h4>

            {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="form-group">
                    {!! Form::label('body', 'Comentario:') !!}
                    {!! Form::textarea('body', null, ['class'=>'form-control', 'rows' => 3]) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Enviar comentario', ['class'=>'btn  btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    @else
        <h4>Inicia sesión para comentar</h4>
    @endif
    <hr>
    <!-- Posted Comments -->
    @if(count($comments) > 0)
        @foreach($comments as $comment)
            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="{{ $comment->photo }}" height="64px" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{ $comment->author }}
                        <small>{{ $comment->created_at->format('d-m-Y H:m') }}</small>
                    </h4>
                    <p>{{ $comment->body }}</p>
                    @if(count($comment->replies) > 0)
                        @foreach($comment->replies as $reply)
                            @if($reply->is_active == 1)
                                <!-- Nested Comment -->
                                <div id="nested-comment" class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" src="{{ $reply->photo }}" height="64px" alt="">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ $reply->author }}
                                            <small>{{ $reply->created_at->format('d-m-Y H:m') }}</small>
                                        </h4>
                                        <p>{{ $reply->body }}</p>
                                    </div>
                                    <!-- End Nested Comment -->
                                </div>
                            @endif
                        @endforeach
                            <div class="comment-reply-container">
                                <button class="toggle-reply btn btn-primary pull-right">Responder</button>
                                <div class="comment-reply  col-sm-6">
                                    {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}
                                    <div class="form-group">
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                        {!! Form::label('body', 'Comentario:') !!}
                                        {!! Form::textarea('body', null, ['class'=>'form-control', 'rows' => 1]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::submit('Enviar comentario', ['class'=>'btn btn-primary']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                    @else
                        <div class="comment-reply-container">
                            <button class="toggle-reply btn btn-primary pull-right">Responder</button>
                            <div class="comment-reply  col-sm-6">
                                {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}
                                <div class="form-group">
                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                    {!! Form::label('body', 'Comentario:') !!}
                                    {!! Form::textarea('body', null, ['class'=>'form-control', 'rows' => 1]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::submit('Enviar comentario', ['class'=>'btn btn-primary']) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
@stop
@section('scripts')
    <script>
        $(".comment-reply-container .toggle-reply").click(function() {
            $(this).next().slideToggle("slow");
        });
    </script>
@stop
