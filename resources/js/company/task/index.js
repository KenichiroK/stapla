$(function(){
    //もっと見る
    let taskDefault = 5;
    const allListCount = $('.task-container__wrapper__table-wrapper__table > tbody').children('tr').length;
    const itemList = $('.task-container__wrapper__table-wrapper__table > tbody').children('tr');

    const defaultShowList = () => {
        itemList.hide();
        for(let i = 0; i < taskDefault; i++){
            $(itemList[i]).show(); 
        }
    }

    const showMoreList = () => {
        $('#task-index_showmore-btn').on('click', () =>{
            taskDefault += 4;
            for(let i = 0; i < taskDefault; i++){
                $(itemList[i]).show();
            }
            hideShowMoreBtn();
        });
    }

    const hideShowMoreBtn = () => {
        if(taskDefault >= allListCount){
            $('#task-index_showmore-btn').hide();
        }
    }

    defaultShowList();
    showMoreList();
    hideShowMoreBtn();
});