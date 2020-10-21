export default {
    state: () => ({
        userPosts: [],
        userSelectedPost: {}
    }),
    mutations: {
        updatePosts(state, userPosts) {
            state.userPosts = userPosts;
        },
        updateSelectedPost(state, post) {
            state.userSelectedPost = post;
        }
    },
    actions: {
        addPost({ state, commit }, payload) {
            return this.$axios.$post(`/posts`, payload).then((post) => {
                commit('updatePosts', [...state.userPosts, post])
            })
        },
        deletePost({ state, commit }, postId) {
            return this.$axios.$delete(`/posts/${postId}`).then(() => {
                commit('updatePosts', state.userPosts.filter(post => post.id != postId))
            })
        },
        editPost({ state, commit }, payload) {
            return this.$axios.$put(`/posts/${payload.id}`, payload).then((post) => {
                commit('updatePosts', state.userPosts.map(post => post.id == payload.id ? payload : post))
            })
        },
        getPost({ state }, postId) {
            const post = state.userPosts.find(item => item.id == postId);
            return post ? Promise.resolve(post) : this.$axios.$get(`/posts/${postId}`);
        }
    }
}