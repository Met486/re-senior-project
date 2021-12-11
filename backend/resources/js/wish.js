const { isEmpty } = require("lodash");

const s1Category = document.getElementById('s1_category');
const s2Category = document.getElementById('s2_category');
const selectCategory = document.getElementById('category');
const d1Category = document.getElementById("d1_category");
const d2Category = document.getElementById("d2_category");
const d3Category = document.getElementById("d3_category");
const isbn_13 = document.getElementById("isbn_13");
const tilte = document.getElementById("title");
const bookConfirm = document.getElementById("book_confirm");
const confirmTitle = document.getElementById("confirm_title");
const confirmAuthor = document.getElementById("confirm_author");
const confirmPublisher = document.getElementById("confirm_publisher");
const confirmCover = document.getElementById("confirm_cover");
const confirmDate = document.getElementById("confirm_date");
const cover = document.getElementById("cover");

// const confrimHan = document.getElementById("confirm_han");
// s2Category.style.display = "none";
// selectCategory.style.display = "none";

d2Category.style.display = "none";
d3Category.style.display = "none";
bookConfirm.style.display = "none";
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

isbn_13.addEventListener("change", function(){

    var bdUrl =  "https://api.openbd.jp/v1/get?isbn=" + isbn_13.value.replace( /[^0-9]/, "");

    // $.ajax({
    //     // url: "https://api.openbd.jp/v1/get?isbn=9784492534434",
    //     url: bdUrl,
    //     data: {
    //         zipcode: 97201
    //     },
    //     success: function( result ) {
    //         // $( "#weather-temp" ).html( "<strong>" + result + "</strong> degrees" );
    //         console.log(result);
    //         console.log("type is " + typeof(result));
    //         console.log(result[0].summary.title);
    //         // const from_json = JSON.parse(result);
    //         // console.log(from_json);
    //         title.value = result[0].summary.title;
    //         author.value = result[0].summary.author;
    //     }
    // });

    $.ajax({
        method: "GET",
        url: bdUrl,
        data: {
            zipcode: 97201
        },
    })
        .done(function(result) {
            console.log(result);
            console.log("type is " + typeof(result));
            console.log(result[0].summary.title);
            // const from_json = JSON.parse(result);
            // console.log(from_json);
            title.value = result[0].summary.title;
            confirmTitle.value = result[0].summary.title;
            confirmAuthor.value = result[0].summary.author;
            confirmDate.value = result[0].summary.pubdate;
            confirmPublisher.value = result[0].summary.publisher;
            confirmCover.src = result[0].summary.cover;
            cover.value = result[0].summary.cover;
            bookConfirm.style.display = "block";
            console.log("cover link is "+cover.value);
        });

})