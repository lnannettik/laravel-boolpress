<template>

    <div class="container">
        <h1 class="my-5">OUR BLOG</h1>

        <div v-if="posts">
            <article class="mb-4" v-for="post in posts" :key="`post-${ post.id }`">
                <h2>{{ post.title }}</h2>
                <div class="mb-4">{{ formatDate(post.created_at) }}</div>
                <p>{{ getExcerpt(post.content, 100) }}</p>

            </article>

            <!-- PAGINAZIONE -->
            <section class="pagination">

                <button
                    class="btn btn-primary mr-3"
                    :disabled="pagination.current === 1"
                    @click="getPosts(pagination.current - 1)"
                >
                    Prev
                </button>

                <button
                    class="btn mr-3"
                    :class="pagination.current === i ? 'btn-primary' : 'btn-secondary'"
                    v-for="i in pagination.last"
                    :key="`page-${i}`"
                    @click="getPosts(i)"
                >
                    {{ i }}

                </button>

                <button 
                    class="btn btn-primary mr-3"
                    :disabled="pagination.current === pagination.last"
                    @click="getPosts(pagination.current + 1)"
                >
                    Next
                </button>
                
            </section>
        </div>

        <Loader v-else />

    </div>

</template>

<script>
import axios from 'axios';
import Loader from '../components/Loader';


export default {
    name:'App',
    components: {
        Loader
    },
    data() {
        return {
            posts: null,
            pagination: null,
        }
    },

    created() {
        this.getPosts();
    },

    methods: {
        getPosts(page = 1) {
            // console.log('AXIOS CALL HERE');

            axios.get(`http://127.0.0.1:8000/api/posts?page=${page}`)
                .then(res => {
                    console.log(res);

                    // A. senza paginazione
                    this.posts = res.data;

                    // B. con paginazione
                    this.posts = res.data.data;
                    this.pagination = {
                        current:res.data.current_page,
                        last:res.data.last_page
                    };
                });
                // .catch();

        },

        getExcerpt(text, maxLength) {
            if(text.length > maxLength) {
                return text.substr(0, maxLength) + '...';
            }

            return text;
        },

        formatDate(postDate) {
            // console.log(postDate);
            const date = new Date(postDate);
            // console.log(date);

            const formatted = new Intl.DateTimeFormat('it-IT').format(date);
            return formatted;

        }
    }

}
</script>

<style lang="scss">

    div {
        h1{
            text-transform: uppercase;
        }
    }

</style>