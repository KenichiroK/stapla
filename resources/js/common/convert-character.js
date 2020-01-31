$('body').on('blur', '.js-c-zenkaku2hankaku', zenkaku2hankaku);

function zenkaku2hankaku(e) {
    half_size_number = e.target.value.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
        return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
    });
    e.target.value = half_size_number
}
