<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Giphy</title>
    
        <link href="{{ asset('/css/boostrap/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/local.css') }}" rel="stylesheet">

        <script src="{{ asset('/js/jquery.min.js') }}"></script>
        <script src="{{ asset('/js/bootstrap/bootstrap.min.js') }}"></script>    
        <script src="{{ asset('/js/vue.min.js') }}"></script>    
    </head>
    <body>
        <div class='header'>
            <nav class='navbar navbar-default'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href="javascript:;">Giphy</a>
                    </div>
                </div>
            </nav>
        </div>
        <div class='content'>
            <div class='container'>
                <div class='page-header'>
                    <h1>Meme</h1>      
                </div>
                <div class='page-content' id='gif'>
                    <div v-if='loading' class='loader-container'>
                        <img class='loader' src="{{ asset('/images/loader.gif') }}" />
                    </div>
                    <div v-else class='gif-container d-flex flex-row flex-wrap'>
                        <div class='gif-item' v-for='gif in gifs'>
                            <a href='javascript:;' v-on:click="view(gif)">
                                <img v-bind:src='gif.images.fixed_width.url'/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">GIF Data</h5>
                    </div>
                    <div class="modal-body">
                        <pre></pre>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script type='text/javascript'>

        const app = new Vue({
            el:"#gif",
            data:{
                gifs:[],
                loading:true,
                selected:null   
            },methods:{
                view:function(data){
                    this.selected = data;
                    this.$nextTick();

                    $('.modal .modal-body pre').html(JSON.stringify(data,null,4));
                    $('.modal').modal('toggle');
                }
            },mounted:function(){
                const that = this;

                $.get('/gif',function(res){
                    if(res.success){
                        that.gifs = res.data;
                    }else{
                        alert(res.message);
                    }

                    that.loading = false;
                });
            }
        });
    </script>
</html>
        