$(function(){
    const projectShow = () => {
        let projectDefault = 4;
        const allListCount = $('.project-container__table > tbody').children('tr').length;
        const itemList = $('.project-container__table > tbody').children('tr');
    
        const defaultShowList = () => {
            itemList.hide();
            for(let i = 0; i < projectDefault; i++){
                $(itemList[i]).show(); 
            }
        }
    
        const showMoreList = () => {
            $('#projectShowMoreBtn').on('click', () =>{
                projectDefault += 4;
                for(let i = 0; i < projectDefault; i++){
                    $(itemList[i]).show();
                }
                hideShowMoreBtn();
            });
        }
    
        const hideShowMoreBtn = () => {
            if(projectDefault >= allListCount){
                $('#projectShowMoreBtn').hide();
            }
        }
        defaultShowList();
        showMoreList();
        hideShowMoreBtn();
    }
    projectShow();

    const taskShow = () => {
        let taskDefault = 4;
        const allListCount = $('.task-container__table > tbody').children('tr').length;
        const itemList = $('.task-container__table > tbody').children('tr');
    
        const defaultShowList = () => {
            itemList.hide();
            for(let i = 0; i < taskDefault; i++){
                $(itemList[i]).show(); 
            }
        }
    
        const showMoreList = () => {
            $('#taskShowMoreBtn').on('click', () =>{
                taskDefault += 4;
                for(let i = 0; i < taskDefault; i++){
                    $(itemList[i]).show();
                }
                hideShowMoreBtn();
            });
        }
    
        const hideShowMoreBtn = () => {
            if(taskDefault >= allListCount){
                $('#taskShowMoreBtn').hide();
            }
        }
    
        defaultShowList();
        showMoreList();
        hideShowMoreBtn();
    }
    taskShow();

});