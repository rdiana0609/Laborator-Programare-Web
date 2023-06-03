let selectMenu=document.querySselector("#products");
let heading = document.querySelector(".right h2");
let container =document.querySelector(".product-wrapper");

selectMenu.addEventListener("change",function(){
    let categoryName=this.value;
    heading.innerHTML=this[this.selectedIndex].text;
    
    let http= new XMLHttpRequest();
    
    http.onload =function(){
        if(this.readyState==4 && this.status==200){
            let response = JSON.parse(this.responseText);
            let out="";
            for(let item of response){
               out += `
                    <div class="product">
                            <div class="left">
                                <img src="?php echo $product[;image] ?>" alt="">
                            </div>
                            <div class="right">
                            <p class="title"><?php echo $product['title']?></p>
                            <p class="price"><?php echo $product['price']?></p>
                            <p class="description"><?php echo $product['description']?></p>
                            </div>
                    </div>
                    `;
            }
        }
    }

    http.open('POST',"http://localhost/pb6/script.php");
    http.setRequestHeader("content-type","application/x-www-form-urlencoded");
    http.send("category="+categoryName);

});