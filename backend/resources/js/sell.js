const { isEmpty } = require("lodash");

const s1Category = document.getElementById('s1_category');
const s2Category = document.getElementById('s2_category');
const selectCategory = document.getElementById('category');
const d1Category = document.getElementById("d1_category");
const d2Category = document.getElementById("d2_category");
const d3Category = document.getElementById("d3_category");
// s2Category.style.display = "none";
// selectCategory.style.display = "none";

d2Category.style.display = "none";
d3Category.style.display = "none";

// $.ajax()を呼び出す際の options の値をあらかじめ設定
$.ajaxSetup({
    type: "GET",
    timeout: 10000, // 10sec
  });

var testArr = $('<option>', { text : "選択してください"});


s1Category.onchange = function(){
    $.ajax({
        url: "getSubCategory/" + this.value,
        dataType: "json",
    })
    .done((res) => {
        console.log("success");
        // s2Category.style.display = "block";
        d2Category.style.display = "block";

        $('#s2_category option').remove();

        // test
        // $.each(res, function (index,data){
        //     // $('#sub_category').append($('<option>').text(data.name).attr('value',.id));
        //     $('#sub_category').append($('<option>').text(data.name).attr({ value: data.id}));
            
        // });
        
        $('#s2_category').append(testArr);

        var arr = $.map(res, function(data){
            $option = $('<option>', { value: data.id, text:data.name});
            return $option;
        });
        $('#s2_category').append(arr);


        // $.each(res, function (index, value){
        //  console.log(value.id + ":" + value.name);
        // });
    })
    .fail((error) => {
        console.log(error.statusText);
    });
}


s2Category.onchange = function(){
    $.ajax({
        url: "getSubCategory/" + this.value,
        dataType: "json",
    })
    .done((res) => {
        console.log("success");
        d3Category.style.display = "block";

        $('#category option').remove();
        $('#category').append(testArr);

        var arr = $.map(res, function(data){
            $option = $('<option>', { value: data.id, text:data.name});
            return $option;
        });
        $('#category').append(arr);

    })
    .fail((error) => {
        console.log(error.statusText);
    });
}


