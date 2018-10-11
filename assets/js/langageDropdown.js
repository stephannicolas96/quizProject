function openDropdown(div) {
    $(div).addClass('active');
    $(div)
}
window.onload = function () {
    let langageDropdown = document.getElementById('langageDropdown');
    document.onclick = function (e) {
        if (e.target.id != 'langageDropdown' && langageDropdown.classList.contains('active') && !e.target.classList.contains('btn-clear')) {
            langageDropdown.classList.remove('active');
        }
    };
};