$('body').on('blur', '.js-c-zenkaku2hankaku', zenkaku2hankaku);

function zenkaku2hankaku(full_width) {
    half_size_number = full_width.target.value.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
        return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
    });
    document.getElementById(full_width.target.id).value = half_size_number
}
