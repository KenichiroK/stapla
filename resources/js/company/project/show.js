$(function(){
    //もっと見る
    let defaultCount = 2;
    const allListCount = $(".task-item-list").length;
    const taskItemList = $('.task-show-link').children('ul');

    const defaultShowList = () => {
        taskItemList.hide();
        for(let i = 0; i < defaultCount; i++){
            $(taskItemList[i]).show(); 
        }
    }

    const showMoreList = () => {
        $('#showmore_task_btn').on('click', () =>{
            defaultCount += 2;
            for(let i = 0; i < defaultCount; i++){
                $(taskItemList[i]).show();
            }
            hideShowMoreBtn();
        });
    }

    const hideShowMoreBtn = () => {
        if(defaultCount >= allListCount){
            $('#showmore_task_btn').hide();
        }
    }

    defaultShowList();
    showMoreList();
    hideShowMoreBtn();

    //アクティビティログメニューを表示する
    const openMenu = () => {
        $('#activity-display-btn').on('click', () => {
            $('.activity-log-menu').show();
        });
    }

    openMenu();

    //アクティビティメニューを消す
    const closeMenu = () => {
        $('#close-btn').on('click', () => {
            $('.activity-log-menu').hide();
        });
    }

    closeMenu();
});