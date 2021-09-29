const selectCategory = document.getElementById('category');

$.ajaxSetup({
    type: "GET",
    timeout: 10000, // 10sec
  });

selectCategory.onchange = function(){
    console.log("category change");
}