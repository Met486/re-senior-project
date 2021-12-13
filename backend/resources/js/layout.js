const { isEmpty } = require('lodash');
import { Carousel,Modal } from 'bootstrap';

const selectCategory = document.getElementById('category');
const selectCategory2 = document.getElementById('category2');
const selectCategory3 = document.getElementById('category3');
const keyword = document.getElementById('keyword');
const price = document.getElementById('price');
const isWish = document.getElementById('wish');

const key_btn = document.getElementById('key_btn');

key_btn.onclick = async function(){

    var PRICE = '';
    var WISH = '';
    if(price)
    {
        PRICE = await price.value;
    }

    if(isWish)
    {
        WISH = await isWish.checked;
    }


    if(!isEmpty(selectCategory) && !(selectCategory.value == '')){
        if(!isEmpty(selectCategory2) && !(selectCategory2.value == '')){
            if(!isEmpty(selectCategory3) && !(selectCategory3.value == '')){
                window.location.href = '/search?' + 'keyword=' + keyword.value  + '&isWish=' + WISH  + '&price=' + PRICE + '&category=' + selectCategory.value + '&category2=' + selectCategory2.value + '&category3=' + selectCategory3.value;
            }
            else{
                window.location.href = '/search?' + 'keyword=' + keyword.value  + '&isWish=' + WISH  + '&price=' + PRICE +'&category=' + selectCategory.value + '&category2=' + selectCategory2.value;
            }
        }
        else{
            window.location.href = '/search?' + 'keyword=' + keyword.value  + '&isWish=' + WISH  + '&price=' + PRICE + '&category=' + selectCategory.value;
        }
    }
    else{
        window.location.href = '/search?' + 'keyword=' + keyword.value + '&isWish=' + WISH  + '&price=' + PRICE;
    }

}
    
