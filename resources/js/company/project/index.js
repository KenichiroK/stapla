$(function(){
    //もっと見る
    let projectDefault = 4;
    const allListCount = $(".item-list").length;
    const itemList = $('.show-link').children('ul');

    const defaultShowList = () => {
        itemList.hide();
        for(let i = 0; i < projectDefault; i++){
            $(itemList[i]).show(); 
        }
    }

    const showMoreList = () => {
        $('#showmore_btn').on('click', () =>{
            projectDefault += 4;
            for(let i = 0; i < projectDefault; i++){
                $(itemList[i]).show();
            }
            hideShowMoreBtn();
        });
    }

    const hideShowMoreBtn = () => {
        if(projectDefault >= allListCount){
            $('#showmore_btn').hide();
        }
    }

    defaultShowList();
    showMoreList();
    hideShowMoreBtn();
});