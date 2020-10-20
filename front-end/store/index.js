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
    }
}