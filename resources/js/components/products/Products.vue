<template>
    <div class="container">
        <div class="row p-4 d-flex justify-content-end input-group">
            <input type="search" class="form-control col-4" placeholder="Search">
            <div class="input-group-append">
                <span class="input-group-text " id="basic-addon2"><i class="fas fa-search"></i></span>
            </div>
        </div>
        <div class="row">
            <aside class="col-3 pt-4">
                <menu-aside/>
            </aside>
            <section class="col-9 pt-4"> 
                <div  v-for="(product, index) in products" :key="index" class="card mb-4 col-12">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="https://media.istockphoto.com/photos/mens-black-blank-tshirt-templatefrom-two-sides-natural-shape-on-for-picture-id1151955707" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title">{{product.name}}</h5>
                                    <p class=" float-right">{{product.brand.name}}</p>
                                </div>
                                <p class="card-text">{{product.excerpt}}</p>
                                <hr>
                                <div class="mb-4 text-right">
                                    <a v-for="(category, index) in product.categories" :key="index" class="btn btn-link">
                                        #{{category.name}}
                                    </a>
                                </div>
                                <div class="d-flex justify-content-around pt-4">
                                    <a :href="`/product/getInformation/${product.id}`" class="btn btn-outline-primary">Details</a>
                                    <a href="#" class="card-text btn btn-success"><b>Comprar</b> ${{product.price}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="product_exists">
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Important</h4>
                        <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                        <hr>
                        <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                    </div>
                </div>

            </section>
        </div>
    </div>
</template>
<script>
import MenuAside from './../aside/Menu.vue'

    export default {
        components:{
            MenuAside,
        },
        data(){
            return{
                product_exists: true,
                products: [],
            }
        },

        created(){
            this.getProducts()
        },
        mounted() {

        },
        methods:{
            async getProducts(){
                await axios.post(`api/products/information`).then(res => {
                    this.products = res.data
                    if(this.products.length != 0){
                        this.product_exists = false
                    }
                })
            }
        }
    }
</script>