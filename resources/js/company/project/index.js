$(function(){
    //もっと見る
    let defaultCount = 4;
    const allListCount = $(".item-list").length;
    const itemList = $('.project-container__content').children('ul');

    const defaultShowList = () => {
        itemList.hide();
        for(let i = 0; i < defaultCount; i++){
            $(itemList[i]).show(); 
        }
    }

    const showMoreList = () => {
        $('#showmore_btn').on('click', () =>{
            defaultCount += 4;
            for(let i = 0; i < allListCount; i++){
                if(i < defaultCount){
                    $(itemList[i]).show();
                }
            }
            hideShowMoreBtn();
        });
    }

    const hideShowMoreBtn = () => {
        if(defaultCount >= allListCount){
            $('#showmore_btn').hide();
        }
    }

    defaultShowList();
    showMoreList();
    hideShowMoreBtn();
});