const selectCategory = document.getElementById('category');

// $.ajax()を呼び出す際の options の値をあらかじめ設定
$.ajaxSetup({
    type: "GET",
    timeout: 10000, // 10sec
  });


selectCategory.onchange = function(){
    $.ajax({
        url: "getSubCategory/" + this.value,
        dataType: "json",
    })
    .done((res) => {
        console.log("success");
        $('#sub_category option').remove();

        // test
        // $.each(res, function (index,data){
        //     // $('#sub_category').append($('<option>').text(data.name).attr('value',.id));
        //     $('#sub_category').append($('<option>').text(data.name).attr({ value: data.id}));
            
        // });

        var arr = $.map(res, function(data){
            $option = $('<option>', { value: data.id, text:data.name});
            return $option;
        });
        $('#sub_category').append(arr);


        // $.each(res, function (index, value){
        //  console.log(value.id + ":" + value.name);
        // });
    })
    .fail((error) => {
        console.log(error.statusText);
    });
}


