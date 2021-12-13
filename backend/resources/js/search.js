const { isEmpty } = require("lodash");
const selectCategory = document.getElementById('category');
const selectCategory2 = document.getElementById('category2');
const selectCategory3 = document.getElementById('category3');

const d1Category = document.getElementById("d1_category");
const d2Category = document.getElementById("d2_category");
const d3Category = document.getElementById("d3_category");


d2Category.style.display = "none";
d3Category.style.display = "none";

if(!isEmpty(selectCategory.value)){
  d2Category.style.display = "block";
}
if(!isEmpty(selectCategory2.value)){
  d3Category.style.display = "block";
}

$.ajaxSetup({
    type: "GET",
    timeout: 10000, // 10sec
  });

const keyword = document.getElementById('keyword');

selectCategory.onchange = function(){

    console.log("category change");
    var n = "";
    if(window.location.search){
      n = window.location.search.substring(1, window.location.search.length);
    }
    window.location.href = "search?" + "keyword=" + keyword.value + "&category=" + this.value;
    console.log("page change");
}

selectCategory2.onchange = function(){
  if(!isEmpty(selectCategory2) && !(selectCategory2.value == "")){
    window.location.href = "/search?" + "keyword=" + keyword.value + "&category=" + selectCategory.value + "&category2=" + selectCategory2.value;
  }
}

selectCategory3.onchange = function(){
  if(!isEmpty(selectCategory3) && !(selectCategory3.value == "")){
    window.location.href = "/search?" + "keyword=" + keyword.value + "&category=" + selectCategory.value + "&category2=" + selectCategory2.value +"&category3=" + selectCategory3.value;
  }
}
