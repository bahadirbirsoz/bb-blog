<template>
    <div>
        <div class="post" v-for="post in posts">
            <h2>{{post.title}}</h2>
            <p v-html="post.content"></p>
            <a :href="'/#/post/'+post.post_id">Detaya git</a>
            <router-link to="post/">Router link detay</router-link>
        </div>
    </div>

</template>
<script>
    import axios from 'axios';

    export default {
        name: 'BlogList',
        data() {
            return {
                test: "Buraya test metin yazılacak",
                posts: []
            }
        },
        created() {
            axios.get('/api/post')
                .then(response => {
                    // JSON responses are automatically parsed.
                    this.posts = response.data.data
                })
                .catch(e => {
                    this.errors.push(e)
                })

            // async / await version (created() becomes async created())
            //
            // try {
            //   const response = await axios.get(`http://jsonplaceholder.typicode.com/posts`)
            //   this.posts = response.data
            // } catch (e) {
            //   this.errors.push(e)
            // }
        }

    }
</script>
<style scoped>

</style>