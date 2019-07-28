$(function(){
    //もっと見る
    const partnerProjectShow = () => {
        let projectDefault = 4;
        const allListCount = $('#partner-project-table > tbody').children('tr').length;
        const itemList = $('#partner-project-table > tbody').children('tr');
    
        const defaultShowList = () => {
            itemList.hide();
            for(let i = 0; i < projectDefault; i++){
                $(itemList[i]).show(); 
            }
        }
    
        const showMoreList = () => {
            $('#partnerProjectShowMoreBtn').on('click', () =>{
                projectDefault += 4;
                for(let i = 0; i < projectDefault; i++){
                    $(itemList[i]).show();
                }
                hideShowMoreBtn();
            });
        }
    
        const hideShowMoreBtn = () => {
            if(projectDefault >= allListCount){
                $('#partnerProjectShowMoreBtn').hide();
            }
        }
        defaultShowList();
        showMoreList();
        hideShowMoreBtn();
    }
    partnerProjectShow();

    const partnerTaskShow = () => {
        let taskDefault = 4;
        const allListCount = $('#partner-task-table > tbody').children('tr').length;
        const itemList = $('#partner-task-table > tbody').children('tr');
    
        const defaultShowList = () => {
            itemList.hide();
            for(let i = 0; i < taskDefault; i++){
                $(itemList[i]).show(); 
            }
        }
    
        const showMoreList = () => {
            $('#partnerTaskShowMoreBtn').on('click', () =>{
                taskDefault += 4;
                for(let i = 0; i < taskDefault; i++){
                    $(itemList[i]).show();
                }
                hideShowMoreBtn();
            });
        }
    
        const hideShowMoreBtn = () => {
            if(taskDefault >= allListCount){
                $('#partnerTaskShowMoreBtn').hide();
            }
        }
    
        defaultShowList();
        showMoreList();
        hideShowMoreBtn();
    }
    partnerTaskShow();

});