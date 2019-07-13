$(function(){
    // アップロードファイル名表示
    const displayFileName = () => {
        $('#inputFile').on("change", function() {
            var file = this.files[0];
            if(file != null) {
                $('#fileName').text(file.name)
            }
        });
    }

    displayFileName();
});