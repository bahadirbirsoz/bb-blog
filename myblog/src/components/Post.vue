<template>
    <div>
        <div class="post" v-if="postdata">
            <h2>{{postdata.title}}</h2>

        </div>
        <router-link to="/">Anasayfa'ya Git</router-link>
    </div>
</template>
<script>
    import axios from 'axios'

    export default {
        name: 'Post',
        data() {
            return {
                postdata: false
            }
        },
        mounted(arg) {
            axios.get('/api/post/' + this.$attrs.id).then(response => {
                this.postdata = response.data.data
            }).catch(err => {
                console.log(err)
            })
        }
    }
</script>
<style scoped>

</style>