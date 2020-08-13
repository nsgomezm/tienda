<template>
    <div class="container">
        <div class="card my-4" >
            <div class="row no-gutters">
                <div class="col-md-5">
                    <img src="https://media.istockphoto.com/photos/mens-black-blank-tshirt-templatefrom-two-sides-natural-shape-on-for-picture-id1151955707" class="card-img" alt="...">
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
            <li class="list-group-item">
                <div class="d-block text-right">fecha</div>
                <h3>Nombre</h3>
                <p>Comentario</p>
            </li>
            <li class="list-group-item">
                <div class="d-block text-right">fecha</div>
                <h3>Nombre</h3>  
                <p>Dapibus ac facilisis in </p>
            </li>
            <li class="list-group-item">
                <div class="d-block text-right">fecha</div>
                <h3>Nombre</h3>  
                <p>Morbi leo risus </p>
            </li>
            <li class="list-group-item">
                <div class="d-block text-right">fecha</div>
                <h3>Nombre</h3>  
                <p>Porta ac consectetur ac </p>
            </li>
            <li class="list-group-item">
                <div class="d-block text-right">fecha</div>
                <h3>Nombre</h3>  
                <p>Vestibulum at eros </p>
            </li>
        </ul>   
    </div>
</template>

<script>
    export default {
        props: ['product'],

        data(){
            return{
                product_details: this.product
            }
        },
        created(){
        },
        methods:{
        }

    }
</script>

<style lang="scss" scoped>

</style>