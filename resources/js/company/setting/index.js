$(function() {
    //もっと見る
    let projectDefault = 4;
    const allListCount = $(".company_user").length;
    const itemList = $(".company_user");

    const defaultShowList = () => {
        itemList.hide();
        for (let i = 0; i < projectDefault; i++) {
            $(itemList[i]).show();
        }
    };

    const showMoreList = () => {
        $("#more_btn").on("click", () => {
            projectDefault += 4;
            for (let i = 0; i < projectDefault; i++) {
                $(itemList[i]).show();
            }
            hideShowMoreBtn();
        });
    };

    const hideShowMoreBtn = () => {
        if (projectDefault >= allListCount) {
            $("#more_btn").hide();
        }
    };

    defaultShowList();
    showMoreList();
    hideShowMoreBtn();
});
