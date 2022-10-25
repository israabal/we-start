<template>
  
      <div class="box">
      
                <img :src="  product.image" alt="">
                <h3><a href="">  {{ product.title }}</a></h3>
                <p>Price:  {{ product.price }}$</p> 
                <P> Category:  {{ product.category}}</P>
            
                <span v-for="(color,i) in product.colors" :key="i">{{ color }}</span>
           
            </div>
</template>

<script>
export default {
  props:['product']  
}
</script>

<style scoped>

.box{
    width: 31%;
    background: #eee;
    padding: 20px;
    margin: 1%;
    min-height: 250px;
    border-radius: 5px;

}
.box a{
    text-decoration: none;
    color: rgb(251, 149, 166);
}
.box span{
    font-size: 14px;
    padding: 5px;
    background: rgb(212,212,212);
    margin: 0 2px;
    padding: 2px 5px;
    border-radius: 3px;

}

</style>