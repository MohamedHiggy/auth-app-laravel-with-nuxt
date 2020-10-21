<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="main-title mt-5 mb-5">All posts of all users</h2>
      </div>
      <div class="col-sm-12 mb-5">
        <div class="card">
          <div class="card-header">
            <ul class="list-style">
              <li class="list">
                <p class="name">Mohamed higgy</p>
              </li>
              <li class="list">
                <p class="time">25 m</p>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <footer class="blockquote-footer">Some quick example text to build on the card title and make up the
              bulk of the card's content.</footer>
          </div>
        </div>
      </div>
      <div class="col-md-12 text-center">
        <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  middleware: "auth",
  name: "index",
  data() {
    return {
    }
  },
  methods: {}
};
</script>

<style scoped>
  .list-style{
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: space-between;
  }
  .list p{
    margin: 0;
    font-weight: bold;
  }
</style>
