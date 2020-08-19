<template>
    <div class="container">
        <div class="card my-4" >
            <div class="row no-gutters">
                <div class="col-md-5">
                    <img :src="product_details.photo" class="card-img" id="img-zoom" :data-zoom-image="product_details.photo">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h3 class="">{{ product_details.name }}</h3>
                            <h5 class="card-title text-muted">{{ product_details.brand.name }}</h5>
                        </div>
                        <p class="card-text">{{ product_details.description }}</p>
                        <p class="card-text">
                            <small v-for="(category, index) in product.categories" :key="index" class="text-muted">
                                #{{category.name}}
                            </small>
                            <!-- <small class="text-muted"></small> -->
                        </p>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="/home" class="btn btn-link">to return</a>
                            <a href="#" class="card-text btn btn-success"><b>Comprar</b> ${{product.price}} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item" v-for="(comment, index) in product_details.comments" :key="index">
                <div class="d-block text-right">{{comment.created_at}}</div>
                <h3>{{comment.user.name}}</h3>
                <p>{{comment.body}}</p>
            </li>
        </ul>   
        <input type="text" placeholder="Write comment" class="form-control mt-4" v-model="comment" @keyup.enter="storeComment()">
    </div>
</template>

<script>
    window.onload = function(){
        // $(document).ready(function(){
        //     alert('hola')
        // })
        $('#img-zoom').elevateZoom({
            zoomType: "lens",
            lensShape: "rownd",
            scrollZoom: true,
            // tintOpacity: 0.8
        })
    }

    export default {
        props: ['product'],

        data(){
            return{
                product_details: this.product,
                comment: ''
            }
        },
        created(){
        },
        methods:{
            async storeComment(){
                // alert(this.comentario)
                await axios.post(`/comment/insert/${this.product_details.id}/${this.comment}`).then(res => {
                    console.log(res.data)
                    this.product_details.comments.push(res.data)
                    this.comment = ''
                    // this.comment = {}
                    
                }).catch(res => {
                    swal({
                        title: "OOps!!",
                        text: "Debes estar registrado",
                        icon: "warning",
                        buttons: true,
                        buttons: ["Close", "Login"],
                        })
                        .then((willDelete) => {
                        if (willDelete) {
                            window.location.href="/login"
                        }
                    });
                })
            }
        }

    }
</script>

<style lang="scss" scoped>

</style>