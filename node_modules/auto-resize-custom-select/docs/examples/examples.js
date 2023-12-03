function toogleCode(show) {
    let _sections = Array.from(document.querySelectorAll('section'));
    if (show) {
        _sections.forEach(el => {
            el.classList.remove('no-code');
        })
    } else {
        _sections.forEach(el => {
            el.classList.add('no-code');
        })
    }
}

document.querySelector('#nocode').addEventListener("change", function(e) {
    toogleCode(e.target.checked)
});

document.addEventListener("DOMContentLoaded", function() {

    hljs.initHighlightingOnLoad();
    toogleCode(false);

    customSelect('select.default');
    customSelect('select.beau-selecteur');
    customSelect('select.win95');
    customSelect('select.xp');
    customSelect('select.aero');
    customSelect('select.metro');
    customSelect('select.aqua');

});
