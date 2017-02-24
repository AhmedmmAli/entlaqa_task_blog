<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('/css/blog-post.css')}}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
                
                <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

              @if(Auth::check())
                <!-- Blog Post -->
                <!-- Post A Post -->
                  @if(count($errors)>0)
                   <div class="alert alert-danger">
                        <strong>Error: </strong>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                   </div>
                   @endif
                 <form action="{{route('Posts.store')}}" method="post">
                      {{ csrf_field() }}
                            <input type="text" name="title" class="form-control" placeholder="Enter Post">
                            <br>
                            <input type="submit" value="Post" class="btn btn-primary pull-right">
                  </form> 
             <br>
                
                <!-- End Post A Post -->
                <!-- Author -->
                @foreach($storedposts as $post)
                <p class="lead pull">
                    by <a href="#">{{ $post->user->name }}</a>
                </p>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->created_at }}</p>


                <!-- Post Content -->
                <p>{{ $post->postbody }}</p>

                <hr>
               <!-- Comments Display -->
               <div id="comments_{{$post->post_id}}">
                    <?php $comments = $post->displayAllComments($post->post_id); ?>
                         @foreach($comments as $comment)
                             <div class="media-body">
                                  <h4 class="media-heading">Commented By : {{$comment->user->name}}</h4>
                                  {{$comment->com_body}}
                             </div><br>
                         @endforeach
               </div>
                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                       <input type="hidden" id="post_{{$post->post_id}}" name="postid" value="{{$post->post_id}}" >
                        <div class="form-group">
                            <input type="text" id="comment_{{$post->post_id}}" name="com_body" class="form-control" placeholder="Enter Comment">
                        </div>
                     <button type="submit" id="{{$post->post_id}}" class="btn btn-primary saveBtn">Save</button>
                </div>
               @endforeach
                <hr>
              @else
                   <p class="lead">You Have To LogIn To See This Content</p>
              @endif
            </div>
            
            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>
                </div>

                
            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="{{asset('/js/jquery.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('/js/bootstrap.min.js')}}"></script>
    
     
    <script>
     
       $(".saveBtn").click(function(event){
            var postId = event.target.id;
            var comment = $('#comment_'+postId).val();
            if(postId == "" || comment == ""){
                 alert("Enter your comment");
            }else{
          $.ajax({
        type: "GET",
        url: '/add/'+postId+'/'+comment,
        success: function(response) {
             console.log(response);
            $("#comments_"+postId).append('<div class="media-body"><h4 class="media-heading">Commented By :'+response.user+'</h4>'+response.com_body+'</div>');
            $("#comment_"+postId).val("");
        },
        error: function(err){
             console.log(err.responseText);
        }
    });  
            }
       });
        
    </script>


</body>

</html>
