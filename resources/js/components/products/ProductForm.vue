<template>
        <div class="container d-flex justify-content-center">
            <form class="form col-10 p-4 m-4" v-on:submit.prevent="store" enctype="multipart/form-data">
                <h1 class="text-primary text-center"> Manage product </h1>
                <div class="row">
                    <div class="form-row col-12">
                        <div class="form-group col-4">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" v-model="product_information.name">
                        </div>
                        <div class="form-group col-4">
                            <label for="created">Created</label>
                            <input type="text" class="form-control" id="created" v-model="product_information.created_at" disabled>
                        </div>
                        <div class="form-group col-4">
                            <label for="updated">Update</label>
                            <input type="text" class="form-control" id="updated" v-model="product_information.updated_at" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 d-flex flex-column justify-content-between">
                        
                        <!-- <img :src="`{{product_information.photo}}`" alt="imagen" > -->
                        <img :src="image" alt="imagen" >
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Photo product</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="photo" aria-describedby="inputGroupFileAddon01" v-on:change="loadImage">
                                <label class="custom-file-label" for="photo">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <!-- <div class="input-group-prepend"> -->
                                <!-- <label class="input-group-text" for="category">Category</label> -->
                            <!-- </div> -->
                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModal">
                                Selecet categories
                            </button>

                            <!-- <select class="custom-select" id="category">
                                <option :value="category.name" v-for="(category, index) in categories" :key=index>{{category.name}}</option>
                            </select> -->
                        </div>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="category">Brand</label>
                            </div>
                            <select class="custom-select" id="category" v-model="product_information.brand_id">
                                <option :value="brand.id" v-for="(brand, index) in brands" :key=index >{{brand.name}}</option>
                            </select>
                        </div>

                        <div class="form-group my-2">
                            <label for="excerpt">Excerpt</label>
                            <textarea id="excerpt" class="form-control" cols="4" rows="2" v-model="product_information.excerpt">Excerpt</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" class="form-control" cols="6" rows="2" v-model="product_information.description">Description</textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" v-model="product_information.price">
                            </div>
                            <div class="form-group col-6">
                                <label for="stock">Stock</label>
                                <input type="number" class="form-control" id="stock" v-model="product_information.stock">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row  d-flex justify-content-around">
                    <a href="/dashboard" class="btn btn-link">To return</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Select categories</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group">
                            <!-- {{ product_information.categories_id.id }} -->
                                <label :for="index" v-for="(category, index) in categories" :key=index+1 class="list-group-item d-block">
                                    {{ category.name }}
                                    <input type="checkbox" :id="index"  :value="category.id" >
                                </label>
                            </ul>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</template>

<script lang="ts">

    export default {
        props: ['product'],
        
        data(){
            return{
                product_information: this.product,
                categories: [],
                brands: [],
                image: []
            }
        },
        created(){
            this.getCategories()
            this.getBrands()
        },
        methods:{
            async loadImage(e){
                var files = e.target.files || e.dataTransfer.files
                if(!files.length)
                    return
                this.createImage(files[0])
            },
            async createImage(file){
                this.image = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },

            async store(){
                if(this.product.id == null){
                    await axios.post("/product/insertInformation", this.product_information).then(res => {
                        console.log(this.product_information)
                        console.log(res.data)
                        swal("Good job!", "You insert ok!", "success");
                    })
                }else{
                    await axios.post(`/product/updateInformation/${this.product.id}`, this.product_information).then(res => {
                        swal("Good job!", "You product update ok!", "success");
                    })
                }
            },

            async getCategories(){
                await axios.post("/api/categories").then(res => {
                    this.categories = res.data 
                })
            },
            async getBrands(){
                await axios.post("/api/brands").then(res => {
                    this.brands = res.data 
                })
            },

        }



    }
    
</script>

<style scoped>

</style>