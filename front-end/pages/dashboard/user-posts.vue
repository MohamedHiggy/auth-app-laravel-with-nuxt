<template>
  <div class="container">
    <div class="pt-5">
      <template v-if="$auth.user.posts == 0" class="text-center">
      <h2 class="text-center">user has no posts</h2>
    </template>
    <template v-else>
      <h2 class="text-center mb-5">Posts of user: </h2>
      <ul>
        <li v-for="post in $auth.user.posts" :key="post.id">
          <div class="card" style="width: 18rem">
            <div class="card-body">
              <h5 class="card-title">title of post: <br /><span class="card-title-span">{{ post.title }}</span></h5>
              <nuxt-link :to="`/dashboard/${post.id}/single-post`" class="card-link">see more</nuxt-link>
            </div>
          </div>
        </li>
      </ul>
    </template>
    </div>
  </div>
</template>

<script>
export default {
  middleware: "auth",
};
</script>

<style scoped>
ul {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
  list-style: none;
}
.card-title {
  font-size: 20px;
  color: #333333;
}
.card-title  .card-title-span {

  font-size: 16px;
  color: #555555;
}
</style>
