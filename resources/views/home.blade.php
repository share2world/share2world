@extends('layouts.app') 

@section('content')
<div class="container" >
    <div class="row clearfix">
        <div class="col-md-4 col-xs-3 column">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div>任务探索</div>
                    <div>任务探索</div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div>任务探索</div>
                    <div>任务探索</div>
                </div>
            </div>
        </div>

           <div class="col-md-8 col-xs-9 column">
             <ul>
                 <li v-for="i in task">
                    <div class="panel" v-bind:class="{ 'panel-primary': i.status , 'panel-danger': !i.status }">
                        <div class="panel-heading">{{ $user->name }}</div>
                        <div class="panel-body">
                            <div class="col-md-10">
                                <h4> @{{ i.item }} </h4>
                            </div>
                            <div class="col-md-2">

                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="docker row">
                                <div class="opt col-md-3 col-md-offset-9">
                                    <button class="btn btn-primary" :src="i.id" v-on:click="complete(i,1)">完成</button>
                                    <button class="btn btn-danger"  :src="i.id" v-on:click="complete(i,0)" >删除</button>
                                </div>
                            </div>

                           <!--comment start-->
                            <div class="comment">
                                <div class="CommentHeader"><strong>共有105条评论</strong></div>
                                
                                <div class="CommentDocker">
                                    <!-- loop comment item -->
                                    <ul>
                                        <li v-for="comment in i.comments">
                                        <blockquote>
                                            <p><small>user <cite>Mike</cite></small>
                                                @{{ comment.comment }}
                                            </p> 
                                        </blockquote>
                                        </li>
                                    </ul>
                                    <!-- end loop -->
                                </div>

                                <div class="CommentFooter btn"><a href="">点赞</a></div>
                                <div class="CommentPost">
                                    <a type="button" class="btn" v-on:click="comment(i.id)" data-toggle="modal" data-target="#Comment" data-whatever="@mdo">评论</a>
                                </div>
                            </div>

                           <!--comment end-->

                        </div>
                    </div>
                </li> 
            </ul> 
        </div>   
    </div>
</div>




<div class="modal fade" id="Comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">评论</h4>
            </div>
            <div class="modal-body">
                <form id="comment" action="{{url('task/comment')}}" method="POST">
                    <input type="hidden" name="tid" value="te" id="tid">
                    <input type="hidden" name="towho" value=1>
                    <input type="hidden" name="uid" value='{{ $user->id }}'>

                    {{--
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">标题:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div> --}} {{ csrf_field() }}
                    <div class="form-group">
                        {{--  <label for="message-text" class="control-label">发表评论:</label>  --}}
                        <textarea class="form-control" id="message-text" name="comment"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" onclick="comment()">评论</button>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">New message</h4>
            </div>
            <div class="modal-body">
                <form id="taskSend" action="{{url('task')}}" method="POST">
                    {{--
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">标题:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div> --}} {{ csrf_field() }}
                    <div class="form-group">
                        <label for="message-text" class="control-label">任务:</label>
                        <textarea class="form-control" id="message-text" name="task"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="send()">Send message</button>
            </div>
        </div>
    </div>
</div>
 



@endsection 

 @section('js')
<script>

    function send()
    {
         //添加新任务
         $('#taskSend').submit(); 
    } 

    function comment()
    {
        $('#comment').submit();
    }



//Vue 
    const app = new Vue({
        el: '#app',
        data:{
            task:0
        },
        methods:{
            complete: function(i,type){
                if(type == 1){
                    var url= '{{ url('task/complete') }}' + '/' ;
                }else if(type == 0){
                    var url= '{{ url('task/delete') }}' + '/' ;
                }
                url += i.id;
                if(type == 1){
                    $.get(
                        url,
                        function(result){
                            if(result == 1){
                                i.status = 0;
                            }
                        }
                    );      
                }else{
                    $.get(
                        url,
                        function(result){
                            if(result == 1){
                                app.task = app.task.filter(function(e){
                                    return e.id != i.id;
                                });
                            }
                        }
                    );  
                }

            },

            comment: function(id){
                $('#tid').val(id);
            }

        }
    })   


    
    app.task = [];
    @foreach($tasks as $task)
    app.task.push({
        item: '{{ $task->task }}',
        id: {{ $task->id }},
        status: {{ $task->status }},
        comments: [],
    })
    @foreach($task->comments as $comment)
    app.task[app.task.length-1].comments.push(
    {
        uid: {{ $comment->uid }},
        comment: '{{ $comment->comment }}'
    }
    );
    @endforeach
    @endforeach
</script> 

@endsection  