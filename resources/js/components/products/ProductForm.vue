<template>
        <div class="container d-flex justify-content-center">
            <form class="form col-10 p-4 m-4" v-on:submit.prevent="store">
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
                        <img :src="photo" alt="" v-if="showPhoto" style="max-height: 400px">
                        <img :src="product_information.photo" v-if="!showPhoto" style="max-height: 400px">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Photo product</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="photo" aria-describedby="inputGroupFileAddon01" accept="image/*" v-on:change="previewFile">
                                <label class="custom-file-label" for="photo">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="category">Category</label>
                            </div>
                            <select class="custom-select" id="category" v-model="product_information.category_id">
                                <option :value="category.id" v-for="(category, index) in categories" :key=index >{{category.name}}</option>
                            </select>
                        </div>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="brand">Brand</label>
                            </div>
                            <select class="custom-select" id="brand" v-model="product_information.brand_id">
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
            </form>
        </div>
</template>

<script lang="ts">
import ProductDetailsVue from './ProductDetails.vue'

    export default {
        props: ['product'],
        
        data(){
            return{
                product_information: this.product,
                categories: [],
                brands: [],
                file: null,
                photo: '/img/photo.png',
                showPhoto: true,
            }
        },
        created(){
            this.getCategories()
            this.getBrands()

            if(this.product_information.photo != null){
                this.showPhoto = false
            }
        },
        methods:{
            async previewFile(event){
                this.file = event.target.files[0]
                this.photo = URL.createObjectURL(this.file);
                this.showPhoto = true
            },
            
            async store(){
                if(this.product.id == null){
                    let data =  new FormData();

                    data.append('photo', this.file, this.file.name)
                    data.append('name', this.product_information.name)
                    data.append('category_id', this.product_information.category_id)
                    data.append('brand_id', this.product_information.brand_id)
                    data.append('excerpt', this.product_information.excerpt)
                    data.append('description', this.product_information.description)
                    data.append('price', this.product_information.price)
                    data.append('stock', this.product_information.stock)

                    await axios.post("/product/insertInformation", data).then(res => {
                        swal("Good job!", "You insert ok!", "success");
                    })
                }else{
                    let data =  new FormData();
                    if(this.file == null){
                        data.append('photo', this.product_information.photo)
                    }else{
                        data.append('photo', this.file, this.file.name)
                    }
                    data.append('name', this.product_information.name)
                    data.append('category_id', this.product_information.category_id)
                    data.append('brand_id', this.product_information.brand_id)
                    data.append('excerpt', this.product_information.excerpt)
                    data.append('description', this.product_information.description)
                    data.append('price', this.product_information.price)
                    data.append('stock', this.product_information.stock)

                    await axios.post(`/product/updateInformation/${this.product.id}`, data).then(res => {
                        swal("Good job!", "You product update ok!", "success");
                    })
                }
            },

            async getCategories(){
                await axios.post("/api/categoriesController").then(res => {
                    this.categories = res.data 
                })
            },
            async getBrands(){
                await axios.post("/api/brandsController").then(res => {
                    this.brands = res.data 
                })
            },

        }



    }
    
</script>

<style scoped>

</style>