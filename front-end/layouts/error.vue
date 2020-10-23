<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="error-card text-center">
            <p class="title">404 Page not Found</p>
            <div class="img">
              <img src="@/assets/404-page-not-found.svg" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .box {
    padding: 200px 0;
  }
  .error-card {
    width: 50%;
    margin: 0 auto;
    text-align: center;
  }
  .title{
    font-weight: bold;
    font-size: 30px;
    margin: 0;
  }
  .img {
    width: 50%;
    margin: 0 auto;
  }
  .img img{
    width: 100%;
  }
</style>
