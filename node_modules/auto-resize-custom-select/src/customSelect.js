const customSelect = function(_config) {

    let defaultOptions = {
        el : 'select',
        className : 'custom-select',
        expandChar : '\u25BE',
        width : false,
        injectCSS : true
    }
    let config = ( typeof(_config) == 'string' ) ? { el : _config } : _config;
    let settings = {...defaultOptions, ...config}

    function getSelected(selector) {
        let _options = selector.options;
        let _selected = selector.options.selectedIndex;
        let _selectedContent = _options[_selected].innerHTML;
        return _selectedContent;
    }
    function setSelected(selector, selection, arrow) {
        selection.innerHTML = getSelected(selector);
        selector.style.width = (selection.offsetWidth + arrow.offsetWidth) + 'px';
        selector.style.height = selection.offsetHeight + 'px';
    }

    let elements = document.querySelectorAll(settings.el);
    let styleId = `custom-select-css-${settings.className}`;
    if (elements.length && document.querySelector('style#' + styleId) === null && settings.injectCSS) {

        let containerWidth = (settings.width) ? ` width: ${settings.width} ` : '';
        let cssContent = `.${settings.className} { position: relative; display: inline-flex; align-items: center; ${containerWidth}} `;
            cssContent += `.${settings.className} .selection { text-decoration: underline; flex: 1 1 auto; } `;
            cssContent += `.${settings.className} .arrow:after { content: '\u00a0${settings.expandChar}' } `;
            cssContent += `.${settings.className} select { all: revert; position: absolute; cursor: pointer; opacity: 0 } `;

        let styleSheet = document.createElement('style');
            styleSheet.id = styleId;
            styleSheet.type = 'text/css';
            styleSheet.appendChild(document.createTextNode(cssContent));

            let _head = document.getElementsByTagName('head')[0];
                _head.insertBefore(styleSheet, _head.firstChild);
    }

    Array.from(elements).forEach((el, i) => {

        let selector = el;

        let container = document.createElement('span');
            container.classList.add(...el.classList);
            container.classList.add(settings.className);

        let selection = document.createElement('span');
            selection.classList.add('selection');

        let arrow = document.createElement('span');
            arrow.classList.add('arrow');

            selector.classList.remove(...selector.classList);
            selector.parentNode.insertBefore(container, selector);

        container.appendChild(selection);
        container.appendChild(arrow);
        container.appendChild(selector);
        setSelected(selector, selection, arrow);

        selector.addEventListener('change', function(e) {

            setSelected(e.target, selection, arrow);
        });

    });
}
