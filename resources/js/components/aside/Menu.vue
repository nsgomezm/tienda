<template>
    <div>
        <div class="accordion" id="categories">
            <div class="card">
                <div class="card-header bg-primary" id="categories">
                    <h2 class="mb-0 ">
                        <button class="btn btn-link btn-block text-left text-decoration-none text-light" type="button" data-toggle="collapse" data-target="#categorisMenu" aria-expanded="true" aria-controls="categorisMenu">
                            Categories
                        </button>
                    </h2>
                </div>
                <div id="categorisMenu" class="collapse" aria-labelledby="categories" data-parent="#categories">
                    <div class="card-body" v-for="(category, index) in categories" :key=index >
                        <a href="#" class="btn btn-link">{{category.name}}</a>
                        <!-- <li ><a href="#" class="btn btn-link d-block text-left"></a></li> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion" id="brands">
            <div class="card">
                <div class="card-header bg-primary" id="brands">
                    <h2 class="mb-0 ">
                        <button class="btn btn-link btn-block text-left text-decoration-none text-light" type="button" data-toggle="collapse" data-target="#brandsMenu" aria-expanded="true" aria-controls="brandsMenu">
                            Brands
                        </button>
                    </h2>
                </div>
                <div id="brandsMenu" class="collapse show" aria-labelledby="brands" data-parent="#brands">
                    <div class="card-body" v-for="(brand, index) in brands" :key=index >
                        <a href="#" class="btn btn-link">{{brand.name}}</a>
                        <!-- <li ><a href="#" class="btn btn-link d-block text-left"></a></li> -->
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <!-- <ul class="list-group list-group-flush">
            <li class="list-group-item active">Brands</li>
            <li v-for="(brand, index) in brands" :key=index class="list-group-item"><a href="#" class="btn btn-link d-block text-left">{{brand.name}}</a></li>
        </ul> -->
    </div>
</template>

<script>
    import MenuItem from './MenuItem.vue'

    export default {
        components:{
            MenuItem
        },
        data(){
            return{
                categories: [],
                brands: [],
            }
        }, 
        created(){
            this.getCategories(),
            this.getBrands()
        },
        methods:{
            async getCategories(){
                await axios.post('/api/categories').then(res => {
                    this.categories = res.data
                })
            },

            async getBrands(){
                await axios.post('/api/brands').then(res => {
                    this.brands = res.data
                })
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>