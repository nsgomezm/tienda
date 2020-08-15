<template>
    <a class="d-block">
        {{ items_menu }}
    </a>
</template>

<script>
    export default {
        props: ['id'],
        data(){
            return{
                items_menu: this.id
            }
        },
        created(){
            // console.log(this.items_menu)
        }
    }
</script>

<style lang="scss" scoped>

</style>