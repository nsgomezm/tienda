<template>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <form class="form col-6 p-4 m-4">
                <h1 class="text-primary text-center"> Manage product </h1>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="category">Category</label>
                    </div>
                    <select class="custom-select" id="category">
                        <option selected>Select</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand">Brand</label>
                    <input type="text" class="form-control" id="brand" v-model="productInformation.brand">
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" v-model="productInformation.name">
                </div>
                <div class="form-group">
                    <label for="excerpt">Excerpt</label>
                    <textarea name="" id="excerpt" class="form-control" cols="4" rows="5" v-model="productInformation.excerpt">Excerpt</textarea>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="" id="description" class="form-control" cols="6" rows="5" v-model="productInformation.description">Description</textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" v-model="productInformation.price">
                    </div>
                    <div class="form-group col-6">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" id="stock" v-model="productInformation.stock">
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Photo product</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="photo">Choose file</label>
                    </div>
                </div>
                <div class="form-group d-flex justify-content-around">
                    <a href="/dashboard" class="btn btn-link">To return</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script lang="ts">
    export default {
        props: ['id'],
        
        data(){
            return{
                productInformation: []
            }
        },

        created(){
            this.getProductInformation()
        },
        mounted() {
            
        },
        methods:{
            async getProductInformation(){
                await axios.post(`/product/information/${this.id}`).then(res => {
                    this.productInformation = res.data
                })
            }
        }
    }
    
</script>

<style scoped>

</style>