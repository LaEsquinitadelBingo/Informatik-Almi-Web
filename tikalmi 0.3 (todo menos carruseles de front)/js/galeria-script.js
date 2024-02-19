const search = document.querySelector(".search-box-galeria input"),
      images = document.querySelectorAll(".image-box");

search.addEventListener("keyup", e =>{
    if(e.key == "Enter"){
        let searchValue = search.value,
            value = searchValue.toLowerCase();
            images.forEach(image =>{
                if(value === image.dataset.name){//aqui se recoge el dato del data-name del html
                    return image.style.display = "block";
                } 
                image.style.display = "none";
            })
    }
});

search.addEventListener("keyup", () =>{
    if(search.value != "") return;
    
    images.forEach(image=>{
        return image.style.display = "block";
    })
});
