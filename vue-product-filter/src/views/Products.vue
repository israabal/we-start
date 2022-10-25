<template>
  <div class="container">
    <section class="main-Wrapper">
        <div class="side">
            <h3>Categories</h3>
            <label @change="filterProducts" v-for="(cat,i) in categories" :key="i">
            <input type="checkbox" v-model="selected_categories"
            :value="cat">{{ cat }}</label>


            <hr>
            <h3>Colors</h3>
            <label  @change="filterProducts" v-for="(color,i) in colors" :key="i">
            <input type="checkbox" v-model="selected_colors"
            :value="color ">{{ color }}</label>

            
            <hr>
            <h3>Price</h3>
            Min: <br>
            <input type="range">
            <br> Max: <br>
            <input type="range">
        </div>
        <div class="content">
                <product-item v-for="product in products "
                 :key="product.id"  :product="product"/>
             
        </div>
     
   </section>
  </div>
</template>
 

<script>
import ProductItem  from '../components/ProductItem.vue';
import products from '../data/MOCK_DATA.json'
export default { 
    components:{ProductItem},
    data(){
        return{
            products
            ,categories:["Structural and Misc Steel","Roofing (Metal)","Curb & Gutter","Wall Protection","Structural & Misc Steel Erection"]
            ,colors:["red","blue","black","pink"]


            ,selected_categories:[]
            ,selected_colors:[],
            baseproducts:products
            }
        },
        methods:{
            filterProducts(){

                this.products= this.baseproducts

                if(this.selected_categories.length > 0){
              this.products= this.baseproducts .filter(p=>this.selected_categories.includes(p.category))}
  
              if(this.selected_colors.length > 0){
                if(this.selected_categories.length > 0){
                    this.products= this.products .filter(p => p.
                    colors.some(c=>this.selected_colors.includes (c)))
                }else{
              this.products= this.baseproducts .filter(p => p.
              colors.some(c=>this.selected_colors.includes (c)))}
            }}
        }}
  
//     watch:{
//         selected_categories: function(){
//             if(this.selected_categories.length>0){
//                 this.products= this.baseproducts .filter(p=>this.selected_categories.includes(p.category))
//             }else{
//                 this.products= this.baseproducts 
//             }
//          },

//          selected_colors: function(){
//             if(this.selected_colors.length>0){
//                 this.products= this.baseproducts .filter(p=>this.selected_categories.includes(p.category))
//             }else{
//                 this.products= this.baseproducts 
//             }
//          },




// }}

</script>
<style  scoped>

.main-Wrapper{
    display: flex;
    margin: 60px 0;
    flex-wrap: wrap;
    

}

.main-Wrapper .side{
    width: 30%;
    padding: 0 20px;
}
.main-Wrapper .content{
    width: 70%;
    padding: 0 20px;
    display: flex;
    align-items: flex-start;
    flex-wrap: wrap ;
}

.side label{
    display: block;
}
</style>