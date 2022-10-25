<template>
  <main>
    <section class="hero">
      <h1>welcome to our app</h1>
      <img src="../assets/www.jpg" alt="">
    </section>
  
  </main>
</template>
<script>
</script>

<style scoped>
.hero h1{
font-size: 60px;
color: #f3b7d0;
/* text-align: center; */
position: absolute;
z-index: 9;
left: 50%;
top: 50%;
transform: translate(-50%,-50%);
margin: 0;
}

.hero{
  position: relative;
}
.hero img{
  height: 500px;
  width: 100%;
  object-fit: cover;
  display: block  ;
}
.hero::before{
 content: '';
 position: absolute;
 width: 100%;
 height: 100%;
 background: rgba(0, 0, 0, .5); 
 top: 0;
 left: 0;
}
</style>