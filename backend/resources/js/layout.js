const { isEmpty } = require("lodash");

const selectCategory = document.getElementById('category');
const selectCategory2 = document.getElementById('category2');
const selectCategory3 = document.getElementById('category3');
const keyword = document.getElementById('keyword');
const key_btn = document.getElementById('key_btn');


key_btn.onclick = function(){
    if(!isEmpty(selectCategory) && !(selectCategory.value == "")){
        if(!isEmpty(selectCategory2) && !(selectCategory2.value == "")){
            if(!isEmpty(selectCategory3) && !(selectCategory3.value == "")){
                window.location.href = "/search?" + "keyword=" + keyword.value + "&category=" + selectCategory.value + "&category2=" + selectCategory2.value + "&category3=" + selectCategory3.value;
            }
            else{
                window.location.href = "/search?" + "keyword=" + keyword.value + "&category=" + selectCategory.value + "&category2=" + selectCategory2.value;
            }
        }
        else{
            window.location.href = "/search?" + "keyword=" + keyword.value + "&category=" + selectCategory.value;
        }
    }
    else{
        window.location.href = "/search?" + "keyword=" + keyword.value;

    }
}