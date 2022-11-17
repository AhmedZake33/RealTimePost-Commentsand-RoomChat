<template>
    <div>

       <div>
          
            <div class="form-group">
            <label for="exampleInputEmail1">Post</label>
            <textarea name="content" v-model="content" class="form-control" required=""></textarea>
            </div><br />
            <button @click="createPost" class="btn btn-primary">Add Post</button>
       
        </div>
        <div>
            <div style="border:1px solid black;padding:15px;margin:10px" v-for="(post,index) in posts" :key="post.id">
                <strong> {{post.content}} </strong><br>
                <span style="color:gray;margin-left:7px">{{post.created_at}}</span>
                <span style="color:gray;margin-left:7px">Created By {{post.user.name}}</span>
                <h6 style="text-decoration:underline">Comments</h6>
                <div v-if="post.comments.length > 0">
                    <div v-for="(comment , index) in post.comments" :key="comment.id">
                        {{++index}}{{comment.comment}}
                    </div>
                </div>
                <input type="text" v-model="comment[index]" class="form-control small" required=""><br>                
                <button @click="addComment(post.id , user.id , index)" class="btn btn-primary">Add Comment</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"PostComponent",
    props:{
        user:Object
    },
    mounted(){
        this.init();
        this.getData();
    },
    data(){
        return {
            content:null,
            posts:[],
            user_id:null,
            post_id:null,
            comment:[]
        }
    },
    methods:{
        init(){
            axios.post('/api/posts').then((response) => {
               this.posts = response.data.posts
            })
        },
        createPost(){
            axios.post('/api/post/create',{content:this.content ,user_id:this.user.id }).then(() => {
                this.content = null
            })
        },
        addComment(post_id , user_id , index){
           console.log({
            'post_id' : post_id,
            'comment' :this.comment[index],
            'user_id' :user_id
           });

            axios.post('/api/comment/create',{
            'post_id' : post_id,
            'comment' :this.comment[index],
            'user_id' :user_id
           }).then(() => {
                this.comment[index] = null
            })
        },
        getData(){
             window.Echo.channel('postChannel')
                .listen('PostsEvent',(e) =>{
                   this.posts.unshift(e.post);
                   console.log(e.post);
            }),

            window.Echo.channel('commentChannel')
                .listen('CommentsEvent',(e) =>{
                 let post = this.posts.find(el => {
                    return el.id == e.comment.post_id
                })
                console.log(post);
                post.comments.unshift(e.comment);
            })
        }
    }
}   
</script>