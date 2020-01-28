function convert(full_width) {
    half_size_number = full_width.value.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
        return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
    });
    document.getElementById(full_width.id).value = half_size_number
}
