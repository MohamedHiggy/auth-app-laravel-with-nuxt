export default {
    state: () => ({
        userPosts: [],
        allPosts: [],
        userSelectedPost: {},
    }),
    mutations: {
        //update posts of user
        updatePosts(state, userPosts) {
            state.userPosts = userPosts;
        },
        //update single post of user
        updateSelectedPost(state, post) {
            state.userSelectedPost = post;
        },
        //update all posts of all user in index.vue
        updateAllPosts(state, allPosts) {
            state.allPosts = allPosts;
        },
    },
    actions: {
        addPost({ state, commit }, payload) {
            return this.$axios.$post(`/posts`, payload).then((post) => {
                commit('updatePosts', [...state.userPosts, post]);
                this.$toast.success('successfuly added');
            })
        },
        deletePost({ state, commit }, postId) {
            return this.$axios.$delete(`/posts/${postId}`).then(() => {
                commit('updatePosts', state.userPosts.filter(post => post.id != postId));
                this.$toast.success('successfuly deleted this post');
            })
        },
        editPost({ state, commit }, payload) {
            return this.$axios.$put(`/posts/${payload.id}`, payload).then((post) => {
                commit('updatePosts', state.userPosts.map(post => post.id == payload.id ? payload : post));
                this.$toast.success('successfuly edit this post');
            })
        },
        getPost({ state }, postId) {
            const post = state.userPosts.find(item => item.id == postId);
            return post ? Promise.resolve(post) : this.$axios.$get(`/posts/${postId}`);
        }
    }
}
